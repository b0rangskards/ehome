<?php namespace App\Repositories;

use App\User;

class UserRepository implements RepositoryInterface{

	public function save(User $user)
	{
		return $user->save();
	}

} 