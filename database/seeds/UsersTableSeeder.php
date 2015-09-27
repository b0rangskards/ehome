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

	    $head = factory(App\User::class, 'head')->create([
		   'email' => 'ehome.uc@gmail.com'
	    ]);

	    // add subscription for head
	    factory(App\Subscription::class, 'free')->create([
		    'user_id' => $head->id
	    ]);
    }
}
