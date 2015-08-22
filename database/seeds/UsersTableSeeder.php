<?php

use App\User;

class UsersTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\User::class, 'admin')->create([
		    'email' => 'admin@gmail.com'
	    ]);

	    factory(App\User::class, 'head')->create([
		   'email' => 'waynearila@gmail.com'
	    ]);
    }
}
