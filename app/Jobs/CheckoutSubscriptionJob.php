<?php

namespace App\Jobs;

use App\Billing\BillingInterface;
use App\Billing\PaypalBilling;
use App\Jobs\Job;
use App\Subscriptions\SubscriptionMessageBuilder;
use App\SubscriptionType;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class CheckoutSubscriptionJob extends Job implements SelfHandling
{
	protected $subscription_type;

	protected $user_id;

	/**
	 * Create a new job instance.
	 *
	 * @param $subscription_type
	 * @param $user_id
	 * @return \App\Jobs\CheckoutSubscriptionJob
	 */
	function __construct($subscription_type, $user_id)
	{
		$this->subscription_type = $subscription_type;
		$this->user_id = $user_id;
	}


	/**
	 * Execute the job.
	 *
	 * @param BillingInterface $billing
	 * @return void
	 */
    public function handle(BillingInterface $billing)
    {
	    $subscriptionType = SubscriptionType::findOrFail($this->subscription_type);
		$user = User::findOrFail($this->user_id);

	    $name = SubscriptionMessageBuilder::getName($subscriptionType);
	    $description = SubscriptionMessageBuilder::getDescription($user, $subscriptionType);

	    $cancelUrl = route('subscriptions.index');
	    $returnUrl = route('subscriptions.success', [$user->id, $subscriptionType->id]);

        $billing->setParams(
	        $name,
	        $description,
	        $subscriptionType->amount,
			$cancelUrl,
	        $returnUrl
            )->checkout();
    }
}
