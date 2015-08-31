<?php  namespace App\Presenters; 

use Carbon;
use Laracasts\Presenter\Presenter;

class SubscriptionPresenter extends Presenter {

	public function subscribedDateInformal()
	{
		return Carbon::parse($this->subscription_start)->diffForHumans();
	}

	public function subscribedDate()
	{
		return Carbon::parse($this->subscription_start)->format('F d Y h:i:s A');
	}

	public function expirationDate()
	{
		return Carbon::parse($this->subscription_end)->format('F d Y h:i:s A');
	}

	public function timeLeft()
	{
		return Carbon::parse($this->subscription_end)->diffForHumans(Carbon::now());
	}

} 