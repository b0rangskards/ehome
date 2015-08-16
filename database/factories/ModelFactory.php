<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function ($faker) {

	$ptBRFaker = Faker\Factory::create('pt_BR');

	$middleInitial = substr($faker->lastName, 0, 1);
	$gender = $faker->randomElement(Config::get('enums.gender'));
	$role = $faker->randomElement(Config::get('enums.roles'));

	return [
        'firstname' => $faker->firstName,
	    'lastname' => $faker->lastName,
	    'middleinitial' => $middleInitial,
		'gender' => $gender,
		'mobile_no' => $ptBRFaker->cellphoneNumber,
	    'email' => $faker->email,
        'password' => 'password1234',
		'role' => $role,
        'remember_token' => str_random(10),
    ];
});