<?php

namespace App;

use App\Helpers\InputFilter;
use App\Helpers\RegistrationHelper;
use Carbon;
use Config;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Laracasts\Presenter\PresentableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, PresentableTrait, SoftDeletes;

	/**
	 * Path to Presenter
	 *
	 * @var string
	 */
	protected $presenter = 'App\Presenters\UserPresenter';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'middleinitial', 'gender',
	                       'mobile_no', 'email', 'password', 'role', 'activation_code',
	                       'activated_at', 'last_login', 'banned_date', 'app_token', 'gcmid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_code'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public static $userBaseChannel = 'user-';

	public static $adminBaseChannel = 'admin-';

	/**
	 * Update user.
	 *
	 * @param $id
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $email
	 * @param $mobile_no
	 * @return mixed
	 */
	public static function updateUser($id, $firstname, $lastname, $middleinitial, $gender, $email, $mobile_no)
	{
		$user = static::findOrFail($id);

		$user->fill(compact('firstname', 'lastname', 'middleinitial', 'gender', 'email'));

		return $user;
	}
	/**
	 * Deactivate user.
	 * Soft Deletes it.
	 *
	 * @param $userId
	 * @return mixed
	 */
	public static function deactivateUser($userId)
	{
		return static::findOrFail($userId)->delete();
	}

	/**
	 * Register household head.
	 * Inserts his user data.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $mobile_no
	 * @param $email
	 * @return static
	 */
	public static function registerHouseholdHead($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$user = new static(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email'));

		$user->password = RegistrationHelper::generateRandomPassword();

		$user->role = Config::get('enums.roles.hh_head');

		$user->activation_code = RegistrationHelper::generateActivationCode();

		return $user;
	}

	/**
	 * Add household member user data.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $mobile_no
	 * @param $email
	 * @return static
	 */
	public static function addHouseholdMember($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$member = new static(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email'));

		$member->password = RegistrationHelper::generateRandomPassword();

		$member->role = Config::get('enums.roles.hh_member');

		$member->activation_code = RegistrationHelper::generateActivationCode();

		return $member;
	}

	/**
	 * Update user data of household member.
	 *
	 * @param $id
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $mobile_no
	 * @param $email
	 * @return mixed
	 */
	public static function updateHouseholdMember($id, $firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$user = static::findOrFail($id);

		$user->fill(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email'));

		return $user;
	}

	/**
	 * Activate user account.
	 *
	 * @param null $password
	 * @return $this
	 */
	public function activateAccount($password = null)
	{
		$this->password = $password;

		$this->activation_code = null;

		$this->activated_at = Carbon::now();

		return $this;
	}


	/**
	 * Determine if this user is household head or not.
	 *
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->role === Config::get('enums.roles.admin');
	}


	/**
	 * Determine if this user is household head or not.
	 *
	 * @return bool
	 */
	public function isHead()
	{
		return $this->role === Config::get('enums.roles.hh_head');
	}

	/**
	 * Determine if this user is household member or not.
	 *
	 * @return bool
	 */
	public function isMember()
	{
		return $this->role === Config::get('enums.roles.hh_member');
	}

	/**
	 * Check User if exist
	 * using his fullname.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @return mixed
	 */
	public static function isNameExist($firstname, $lastname, $middleinitial)
	{
		return static::where('firstname', $firstname)
			->where('lastname', $lastname)
			->where('middleinitial', $middleinitial)
			->first();
	}

	/**
	 * Get channel for this user.
	 * Used for broadcasting events.
	 *
	 * @return string
	 */
	public function getChannel()
	{
		return self::$userBaseChannel.$this->id;
	}

	/**
	 * Get channel for admin user.
	 * Used for broadcasting events.
	 *
	 * @return string
	 */
	public function getAdminChannel()
	{
		return self::$adminBaseChannel . $this->id;
	}

	/*
	 * Touch last_login timestamp
	 * Used When Logging in
	 */
	public function touchOnline()
	{
		$this->last_login = Carbon::now();
		$this->save();
	}

	public function completedTasks()
	{
		if ( !$this->tasks ) return new ModelCollection();

		return $this->tasks->where('status', 'completed');
	}

	public function pendingTasks()
	{
		if(!$this->tasks) return new ModelCollection();

		return $this->tasks->where('status', 'pending');
	}

	public function taskActions()
	{
		return TaskNote::getLatestNotes($this->id);
	}

	public function isActivated()
	{
		return is_null($this->activation_code) && $this->activated_at;
	}
	public function deactivated()
	{
		return !is_null($this->deleted_at);
	}
	public function isBanned()
	{
		return !(is_null($this->deleted_at) || is_null($this->banned_date));
	}

	/* Relationships */

	public function subscriptions()
	{
		return $this->hasMany('App\Subscription', 'user_id', 'id');
	}

	public function tasks()
	{
		return $this->belongsToMany('App\Task', 'task_members')
			->orderBy('status', 'DESC')
			->orderBy('due_at', 'DESC');
	}

	public function household()
	{
		return $this->hasOne('App\Household', 'head_id', 'id');
	}

	// return form household_members table if not household head
	public function memberHousehold()
	{
		return $this->belongsToMany('App\Household', 'household_members');
	}

	public function notifications()
	{
		return $this->hasMany('App\Notification', 'to_userid', 'id')
			->with('sender')
			->orderBy('seen')
			->latest();
	}

	public function unseenNotifications()
	{
		return $this->notifications()
			->where('seen', 0);
	}

	public function userSettings()
	{
		return $this->hasOne('App\UserSetting', 'user_id', 'id');
	}

	/* Scope Query */

	public function scopeCompleted($query)
	{
		return $query->where('status', 'done');
	}

	public function scopePending($query)
	{
		return $query->where('status', 'pending');
	}

	/* Mutators */

//	public function getCleanMobileNoAttribute()
//	{
//		return str_replace('+', '', $this->mobile_no);
//	}

	public function getSubscriptionAttribute()
	{
		return $this->subscriptions()->latest()->first();
	}

	public function getMemberHouseholdAttribute()
	{
		if ($this->isHead()) {
			if(!$this->household) return new Collection();

			return $this->household->members;
		}

		$members = $this->household->getHouseholdMembers($this->id);
		$members->push($this->household->head);
		return $members;
	}
	public function getTasksAttribute()
	{
		if($this->isHead())
		{
			if(!$this->household) return new ModelCollection();
			return $this->household->tasks;
		}
		elseif($this->isMember())
		{
//			if($this->getRelation('tasks')) return new ModelCollection();

			return $this->tasks()->get();
		}

		return Task::all();
	}

	public function getHouseholdAttribute()
	{
		if($this->isHead()) return $this->household()->first();

		return $this->memberHousehold()->first();
	}

	public function setFirstnameAttribute($value)
	{
		$this->attributes['firstname'] = strtolower($value);
	}

	public function setLastnameAttribute($value)
	{
		$this->attributes['lastname'] = strtolower($value);
	}

	public function setMiddleinitialAttribute($value)
	{
		$this->attributes['middleinitial'] = strtolower($value);
	}

	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function setRoleAttribute($value)
	{
		$this->attributes['role'] = strtolower($value);
	}

	public function setGenderAttribute($value)
	{
		$this->attributes['gender'] = strtolower($value);
	}

	public function setMobileNoAttribute($value)
	{
		$this->attributes['mobile_no'] = InputFilter::mobileNumber($value);
	}

	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
	}
}
