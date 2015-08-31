<?php namespace App\Subscriptions;

use App\SubscriptionType;
use App\User;

class SubscriptionMessageBuilder {

	public static function getName(SubscriptionType $subscriptionType)
	{
		return 'User Subscription - ' . $subscriptionType->present()->prettyType;
	}

	public static function getDescription(User $user, SubscriptionType $subscriptionType)
	{
		return $subscriptionType->present()->prettyType.' Subscription billing to ' . $user->present()->prettyName;
	}
} 