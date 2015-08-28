<?php

use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends BaseSeeder
{
	protected $tables = [
		'users',
		'households',
		'household_members',
		'subscription_types'
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
