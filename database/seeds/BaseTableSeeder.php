<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

abstract class BaseTableSeeder extends Seeder {

	protected $faker;

	function __construct(Faker $faker)
	{
		$this->faker = Faker::create();
	}


} 