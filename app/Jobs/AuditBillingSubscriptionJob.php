<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Subscription;
use App\SubscriptionType;
use App\User;
use Carbon;
use Illuminate\Contracts\Bus\SelfHandling;

class AuditBillingSubscriptionJob extends Job implements SelfHandling
{
	protected $user;
	protected $subscriptionType;

	/**
	 * Create a new job instance.
	 *
	 * @param $user
	 * @param $subscriptionType
	 * @return \App\Jobs\AuditBillingSubscriptionJob
	 */
	function __construct(User $user, SubscriptionType $subscriptionType)
	{
		$this->user = $user;
		$this->subscriptionType = $subscriptionType;
	}


	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $start = Carbon::now();
	    $end = Carbon::now()->addDays($this->subscriptionType->no_of_days);

		$subscription = Subscription::extendSubscription(
			$this->user->id,
			$this->subscriptionType->id,
			$start,
			$end
		);

	    // event here to notify admin

	    return $subscription;
    }
}
