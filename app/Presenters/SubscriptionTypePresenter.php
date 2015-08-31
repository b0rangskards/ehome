<?php  namespace App\Presenters; 

use Laracasts\Presenter\Presenter;

class SubscriptionTypePresenter extends Presenter {

	public function prettyType()
	{
		return ucwords($this->type);
	}

	public function prettyAmount()
	{
		return env('PAYPAL_CURRENCY', 'USD') .' '. money_format('%.2n', $this->amount);
	}

	public function prettyDaysCount()
	{
		return $this->no_of_days . ' Days';
	}

} 