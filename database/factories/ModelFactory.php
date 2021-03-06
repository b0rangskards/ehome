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
use App\Household;
use App\SubscriptionType;
use App\User;

$factory->defineAs(App\Subscription::class, 'free', function ($faker) {

	$userId = $faker->randomElement(User::lists('id')->toArray());
	$freeTrial = SubscriptionType::getFreeTrial();


	return [
		'user_id' => $userId,
		'type_id' => $freeTrial->id,
		'subscription_start' => Carbon::now(),
		'subscription_end' => Carbon::now()->addDays($freeTrial->no_of_days)
	];
});

$factory->defineAs(App\Subscription::class, 'premium', function ($faker) {

	$userId = $faker->randomElement(User::lists('id')->toArray());
	$premium = SubscriptionType::getPremium();

	return [
		'user_id' => $userId,
		'type_id' => $premium->id,
		'subscription_start' => Carbon::now(),
		'subscription_end' => Carbon::now()->addDays($premium->no_of_days)
	];
});

$factory->define(App\UserSetting::class, function ($faker) {
	$userId = $faker->randomElement(User::lists('id')->toArray());

	return [
		'user_id' => $userId
	];
});


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
		'activated_at' => Carbon::now(),
        'remember_token' => str_random(10),
    ];
});


$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory) {
	$role = Config::get('enums.roles.admin');
	$user = $factory->raw(App\User::class);

	return array_merge($user, ['role' => $role]);
});

$factory->defineAs(App\User::class, 'head', function ($faker) use ($factory) {
	$role = Config::get('enums.roles.hh_head');
	$user = $factory->raw(App\User::class);

	return array_merge($user, ['role' => $role]);
});

$factory->defineAs(App\User::class, 'member', function ($faker) use ($factory) {
	$role = Config::get('enums.roles.hh_member');
	$user = $factory->raw(App\User::class);

	return array_merge($user, ['role' => $role]);
});

$factory->define(App\Household::class, function ($faker){
	$user = factory(App\User::class, 'member')->create();
	$coordinates = $faker->latitude.','.$faker->longitude;

	return [
		'head_id' => $user->id,
		'address' => $faker->address,
		'coordinates' => $coordinates
	];
});

$factory->define(App\HouseholdMember::class, function ($faker) use ($factory) {
	$user = factory(App\User::class, 'member')->create();
	$household = factory(App\Household::class)->create();

	return [
		'household_id' => $household->id,
		'user_id' => $user->id,
	];
});

