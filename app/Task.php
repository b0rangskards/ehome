<?php

namespace App;

use App\Helpers\FileHelper;
use App\Sms\SmsMessageBuilder;
use Carbon;
use DB;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class Task extends Model
{

	use SoftDeletes, PresentableTrait;

	protected $presenter = 'App\Presenters\TaskPresenter';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';

	protected $fillable = ['household_id', 'parent_id', 'name',
						   'slug', 'description', 'due_at', 'recurring_at',
						   'priority', 'image', 'coordinates', 'status', 'progress'];

	protected $geofields = ['coordinates'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public static $limit = 5;

	public static function getAllActiveTasks()
	{
		return static::active()->get();
	}

	public static function updateTask($id, $name, $due_at, $recurring_at, $priority, $description, $coordinates)
	{
		return static::findOrFail($id)->fill(compact('name', 'due_at', 'recurring_at', 'priority', 'description', 'coordinates'));
	}

	public static function createTask($household_id, $name, $due_at, $recurring_at, $priority, $parent_id = null, $description = null, $coordinates = null)
	{
		$task = new static(compact('household_id', 'name', 'description', 'due_at', 'recurring_at', 'priority', 'coordinates', 'parent_id'));

		$task->slug = $name;

		return $task;
	}


	public static function createSubtask(Task $parentTask, array $subtaskData)
	{
		$subtask = static::createTask(
			$parentTask->household_id,
			$subtaskData['name'],
			$parentTask->due_at,
			$parentTask->recurring_at,
			$parentTask->priority,
			$parentTask->id,
			$subtaskData['description'],
			$parentTask->coordinates
		);

		if ( !is_null($subtaskData['image']) )
		{
			$subTaskFileName = FileHelper::uploadImage($subtaskData['name'], $parentTask->household_id, $subtaskData['image']);

			$subtask->image = $subTaskFileName;
		}

		return $subtask;
	}

	public function updateStatus($status)
	{
		$this->status = $status;
		return $this->save();
	}

	public function deleteOldImage()
	{
		if($this->hasImage() && File::exists($this->directory)) {
			File::delete($this->directory);
			return true;
		}
		return false;
	}

	public function timeLeft()
	{
		return Carbon::now();
	}

	/**
	 * @param $name
	 * @return string
	 */
	public static function generateSlug($name)
	{
		return str_slug($name, '-');
	}

	/* Hack */

	public function newQuery($excludeDeleted = true)
	{
		$query = '';
		foreach ( $this->geofields as $column ) {
			$query .= ' ASTEXT(' . $column . ') as ' . $column . ' ';
		}

		return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($query));
	}

	public static function extractMembers($subtask)
	{
		$members = [];
		foreach($subtask as $index => $value) {
			if(is_numeric($index)) {
				$members[] = $value;
			}
		}
		return $members;
	}

	public function syncMembers(array $members)
	{
		return $this->members()->sync($members);
	}

	public function getMembers($exceptUserId = null)
	{
		$membersCollection = $this->members;
		$membersCollection->push($this->household->head);

		if($exceptUserId) {
			foreach ( $membersCollection as $key => $member ) {
				if ( $member->id === (int)$exceptUserId ) {
					$membersCollection->pull($key);
					break;
				}
			}
		}

		return $membersCollection;
	}

	public function getMember($userId)
	{
		foreach($this->members as $member) {
			if($member->id === $userId)
				return $member;
		}
		return false;
	}

	public function hasMemberOrHead($userId)
	{
		$membersArray = $this->members->lists('id')->toArray();
		$membersArray[] = $this->household->head->id;

		return in_array($userId, $membersArray);
	}

	public function hasMember($userId)
	{
		$membersArray = $this->members->lists('id')->toArray();

		return in_array($userId, $membersArray);
	}

	public function isSubtask()
	{
		return !is_null($this->parent_id);
	}

	public function hasSubtask()
	{
		return !$this->subtasks->isEmpty();
	}

	public function hasImage()
	{
		return $this->image;
	}

	public function hasLocation()
	{
		return $this->coordinates;
	}

	public function hasExpired()
	{
		return Carbon::parse($this->due_at) <= Carbon::now();
	}

	public function parent()
	{
		if($this->parent_id){
			return Task::find($this->parent_id);
		}
		return null;
	}

	public function isImportant()
	{
		return $this->priority === 1;
	}

	public function isAlmostDone()
	{
		return $this->status === 'almost_there';
	}

	public function isPending()
	{
		return $this->status === 'pending';
	}

	public function isDone()
	{
		return $this->status === 'done';
	}

	public function getImageUrl()
	{
		return $this->household->getImagesBaseUrl() . '/task/' . $this->image;
	}

	public function smsCreateMessage()
	{
		return SmsMessageBuilder::newTask(
				$this->household->head->present()->prettyName,
				$this->present()->prettyName
		);
	}

	/* Relationships */

	public function household()
	{
		return $this->belongsTo('App\Household', 'household_id');
	}

	public function members()
	{
		return $this->belongsToMany('App\User', 'task_members')
			->withPivot('accepted');
	}

	/**
	 * @return mixed
	 */
	public function membersWithSms()
	{
		$members = $this->members->lists('id')->toArray();

		return User::with('userSettings')
					->whereHas('userSettings', function($query){
						$query->where('receive_sms', true);
					})
					->whereIn('id', $members)
					->where('mobile_no', '<>', '')
					->whereNotNull('mobile_no')
					->get();
	}

	/**
	 * @return mixed
	 */
	public function membersWithMobileNotifications()
	{
		$members = $this->members->lists('id')->toArray();

		return User::with('userSettings')
			->whereHas('userSettings', function ($query) {
				$query->where('receive_notifications_mobile', true);
			})
			->whereIn('id', $members)
			->where('gcmid', '<>', '')
			->WhereNotNull('gcmid')
			->get();
	}

	public function subtasks()
	{
		return $this->hasMany(static::class, 'parent_id', 'id');
	}

	public function notes()
	{
		return $this->hasMany('App\TaskNote', 'task_id')
			->latest();
	}

	/* Scope Query */

	public function scopeActive($query)
	{
		return $query->where('due_at', '<=', Carbon::now());

	}


	/* Mutators & Accessors */

	/**
	 * Get a list of member id associated with the task.
	 *
	 * @return mixed
	 */
	public function getDirectoryAttribute()
	{
		return $this->household->getTaskImagesDir() . '/' . $this->image;
	}

	public function getTaskMembersAttribute()
	{
		return $this->members->lists('id')->toArray();
	}

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = strtolower($value);
	}

	public function setDescriptionAttribute($value)
	{
		$this->attributes['description'] = strtolower($value);
	}

	public function setRecurringAtAttribute($value)
	{
		$this->attributes['recurring_at'] = strtolower($value);
	}

	public function setImageAttribute($value)
	{
		$this->attributes['image'] = strtolower($value);
	}

	public function setStatusAttribute($value)
	{
		$this->attributes['status'] = strtolower($value);
	}

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = static::generateSlug($value);
	}

	public function setCoordinatesAttribute($value)
	{
		$this->attributes['coordinates'] = $value ? DB::raw("POINT($value)") : NULL;
	}

	public function getCoordinatesAttribute($value)
	{
		$coords = substr($value, 6);
		$coords = preg_replace('/[ ,]+/', ',', $coords, 1);

		return substr($coords, 0, -1);
	}
}
