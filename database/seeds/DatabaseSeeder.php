<?php

use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends BaseSeeder
{
	protected $tables = [
		'subscription_types',
		'users',
		'households',
		'household_members',
		'user_settings'
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->cleanDatabase();

	    Model::unguard();

	    $this->seedTables();

	    Model::reguard();
    }
}
