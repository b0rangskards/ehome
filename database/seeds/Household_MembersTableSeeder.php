<?php

use App\User;

class Household_MembersTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $head = User::where('email', 'ehome.uc@gmail.com')->first();

	    factory(App\HouseholdMember::class, 5)->create([
			'household_id' => $head->household->id
	    ]);
    }
}
