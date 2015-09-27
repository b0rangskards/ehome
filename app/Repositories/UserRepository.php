<?php namespace App\Repositories;

use App\User;
use Auth;
use Config;

class UserRepository implements RepositoryInterface{

	/**
	 * Persist user.
	 *
	 * @param User $user
	 * @return bool
	 */
	public function save(User $user)
	{
		return $user->save();
	}

	public static function getAllAdminChannels()
	{
		$channels = [];

		foreach(self::getAllAdminUsers() as $admin)
		{
			$channels[] = $admin->getAdminChannel();
		}

		return $channels;
	}

	/**
	 * Get all admin user.
	 *
	 * @return mixed
	 */
	public static function getAllAdminUsers()
	{
		return User::where('role', Config::get('enums.roles.admin'))
			->get();
	}

	/* Admin Functions */

	public static function getTableData()
	{
		return User::where('id', '<>', Auth::user()->id)
			->get();
	}

	public static function getTableDataWithTrash()
	{
		return User::withTrashed()
			->where('id', '<>', Auth::user()->id)
			->get();
	}

	public static function getTableHeader()
	{
		return [
			'User',
			'Role',
			'Status',
			'Action',
		];
	}

} 