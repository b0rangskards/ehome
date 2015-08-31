<?php

use App\SubscriptionType;
use Illuminate\Database\Seeder;

class Subscription_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $subscriptions = [
		  ['type' => 'free', 'no_of_days' => 15, 'amount' => 0],
		  ['type' => 'premium', 'no_of_days' => 90, 'amount' => 700]
	    ];

	    foreach($subscriptions as $subscription) {
		    SubscriptionType::create($subscription);
	    }
    }
}
