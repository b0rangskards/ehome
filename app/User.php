<?php

namespace App;

use App\Helpers\InputFilter;
use App\Helpers\RegistrationHelper;
use Carbon;
use Config;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, PresentableTrait, SoftDeletes;

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
	                       'activated_at', 'last_login'];

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

	public static function deactivateUser($userId)
	{
		return static::findOrFail($userId)->delete();
	}

	public static function registerHouseholdHead($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email, $password)
	{
		$user = new static(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email', 'password'));

		$user->role = Config::get('enums.roles.hh_head');

		$user->activation_code = RegistrationHelper::generateActivationCode();

		return $user;
	}

	public static function addHouseholdMember($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$member = new static(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email'));

		$member->password = RegistrationHelper::generateRandomPassword();

		$member->role = Config::get('enums.roles.hh_member');

		$member->activation_code = RegistrationHelper::generateActivationCode();

		return $member;
	}

	public static function updateHouseholdMember($id, $firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$user = static::findOrFail($id);

		$user->fill(compact('firstname', 'lastname', 'middleinitial', 'gender', 'mobile_no', 'email'));

		return $user;
	}

	public function activateAccount()
	{
		$this->activation_code = null;

		$this->activated_at = Carbon::now();

		return $this;
	}

	public function isHead()
	{
		return $this->role === Config::get('enums.roles.hh_head');
	}

	public static function isNameExist($firstname, $lastname, $middleinitial)
	{
		return static::where('firstname', $firstname)
			->where('lastname', $lastname)
			->where('middleinitial', $middleinitial)
			->first();
	}

	/* Relationships */

	public function tasks()
	{
		return $this->belongsToMany('App\Task', 'task_members');
	}

	public function household()
	{
		return $this->hasOne('App\Household', 'head_id', 'id');
	}

	/* Mutators */

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
