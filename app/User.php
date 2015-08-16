<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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

	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
	}
}
