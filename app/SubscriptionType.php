<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class SubscriptionType extends Model
{
	use PresentableTrait;

	/**
	 * Path to Presenter
	 *
	 * @var string
	 */
	protected $presenter = 'App\Presenters\SubscriptionTypePresenter';

    protected $table = 'subscription_types';

	protected $fillable  = ['type', 'no_of_days', 'amount'];

	public static function getPaidSubscriptions()
	{
		return static::where('type', '<>', 'free')
						->get();
	}

	public static function getFreeTrial()
	{
		return static::where('type', 'free')->first();
	}

	public static function getPremium()
	{
		return static::where('type', 'premium')->first();
	}
}
