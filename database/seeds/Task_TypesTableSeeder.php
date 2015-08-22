<?php

use App\TaskType;
use Illuminate\Database\Seeder;

class Task_TypesTableSeeder extends Seeder
{
	private $types = [
		'personal',
		'household chores',
		'shopping',
		'transportation',
		'other'
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->types as $name) {
	        TaskType::create(['name' => $name]);
        }
    }
}
