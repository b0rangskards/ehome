<?php

use App\User;
use Illuminate\Database\Seeder;

class User_SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->getAllUsers() as $user) {
	        factory(App\UserSetting::class)->create([
		        'user_id' => $user->id
	        ]);
        }
    }

	public function getAllUsers()
	{
		return User::all();
	}
}
