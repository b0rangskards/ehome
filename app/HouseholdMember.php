<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseholdMember extends Model
{
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'household_members';

    protected $fillable = ['household_id', 'user_id'];

	/**
	 * No timestamps field on database.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public static function addMember($household_id, $user_id)
	{
		return new static(compact('household_id', 'user_id'));
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function household()
	{
		return $this->belongsTo('App\Household', 'household_id');
	}

}
