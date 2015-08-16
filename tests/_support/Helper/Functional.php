<?php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be available in $I
use App;

class Functional extends \Codeception\Module
{
	public function haveUserData($overrides = [])
	{
		return factory(App\User::class)->make($overrides);
	}

	public function haveUser($overrides = [])
	{
		return factory(App\User::class)->create($overrides);
	}
}
