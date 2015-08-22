<?php

namespace App;

use Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';

	protected $fillable = ['household_id', 'parent_id', 'type_id', 'name',
						   'slug', 'description', 'due_at', 'recurring_at',
						   'priority', 'image', 'coordinates', 'status', 'progress'];

	protected $geofields = ['coordinates'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public static function createTask($household_id, $name, $type_id, $due_at, $recurring_at, $priority, $parent_id = null, $description = null, $coordinates = null)
	{
		$task = new static(compact('household_id', 'name', 'type_id', 'description', 'due_at', 'recurring_at', 'priority', 'coordinates', 'parent_id'));

		$task->slug = $name;

		return $task;
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

	/* Relationships */

	public function members()
	{
		return $this->belongsToMany('App\User', 'task_members');
	}

	public function type()
	{
		return $this->belongsTo('App\TaskType', 'type_id');
	}

	/* Mutators & Accessors */

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
