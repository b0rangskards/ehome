<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Subscription extends Model
{
	use PresentableTrait;

	/**
	 * Path to Presenter
	 *
	 * @var string
	 */
	protected $presenter = 'App\Presenters\SubscriptionPresenter';

    protected $table = 'subscriptions';

	protected $fillable = ['user_id', 'type_id', 'subscription_start', 'subscription_end'];

	public function isExpired()
	{
		$end = Carbon::parse($this->subscription_end);

		return $end->lte(Carbon::now());
	}

	public static function registerFreeTrial($user_id)
	{
		$subscriptionType = SubscriptionType::getFreeTrial();

		$type_id = $subscriptionType->id;

		$subscription_start = Carbon::now();

		$subscription_end = Carbon::now()->addDays($subscriptionType->no_of_days);

		return static::create(compact('user_id', 'type_id', 'subscription_start', 'subscription_end'));
	}

	public static function extendSubscription($user_id, $type_id, $subscription_start, $subscription_end)
	{
		return static::create(compact('user_id', 'type_id', 'subscription_start', 'subscription_end'));
	}

	public function type()
	{
		return $this->belongsTo('App\SubscriptionType', 'type_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}


}
