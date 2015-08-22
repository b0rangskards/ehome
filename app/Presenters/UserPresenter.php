<?php  namespace App\Presenters; 

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function prettyName()
	{
		return ucwords($this->firstname . ' ' . $this->lastname);
	}

	public function prettyRole()
	{
		switch($this->role) {
			case 1:
				return 'Admin';
			case 2:
				return 'Head';
			default:
				return 'Member';
		}
	}

} 