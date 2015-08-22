<?php  namespace App\Presenters; 

use Laracasts\Presenter\Presenter;

class HouseholdPresenter extends Presenter {

	public function prettyAddress()
	{
		return ucwords($this->address);
	}

} 