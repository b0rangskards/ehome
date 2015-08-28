<?php

namespace App;

use Config;
use DB;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Household extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\HouseholdPresenter';

	protected $fillable = ['head_id', 'address', 'coordinates'];

	protected $geofields = ['coordinates'];

	protected $dates = ['deleted_at'];

	public static $dir = '/images/household';

	public static function updateHousehold($household_id, $address, $coordinates)
	{
		$household = static::findOrFail($household_id);
		$household->address = $address;
		$household->coordinates = $coordinates;
		return $household;
	}

	public static function setup($head_id, $address, $coordinates)
	{
		return new static(compact('head_id', 'address', 'coordinates'));
	}

	public function getImagesBaseUrl()
	{
		return asset(static::$dir.'/'.$this->id.'/');
	}

	public function getDir()
	{
		return Config::get('paths.resource_path') . static::$dir . '/' . $this->id;
	}

	public function getTaskImagesDir()
	{
		return $this->getDir() . '/task';
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

	public function getHouseholdMembers($exceptId)
	{
		return HouseholdMember::with('user')
			->where('household_id', $this->id)
			->where('user_id', '!=', $exceptId)
			->get();
	}

	/* Relationships */

	public function getMemberListAttribute()
	{
		$list = [];
		foreach($this->members as $member){
			$list[$member->user->id] = $member->user->firstname;
		}
		return $list;
	}

	public function members()
	{
		return $this->hasMany('App\HouseholdMember', 'household_id', 'id')
			->with('user');
	}

	public function head()
	{
		return $this->belongsTo('App\User', 'head_id', 'id');
	}

	public function tasks()
	{
		return $this->hasMany('App\Task', 'household_id')
			->orderBy('status', 'DESC')
			->orderBy('due_at', 'DESC');
	}

	/* Mutators & Accessors */

	public function setAddressAttribute($value)
	{
		$this->attributes['address'] = strtolower($value);
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
