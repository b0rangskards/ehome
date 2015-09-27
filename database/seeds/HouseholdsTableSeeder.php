<?php

use App\User;

class HouseholdsTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $head = User::where('email', 'ehome.uc@gmail.com')->first();

	    factory(App\Household::class)->create([
		   'head_id' => $head->id
	    ]);
    }
}
