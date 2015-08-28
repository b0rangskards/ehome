<?php  namespace App\Presenters; 

use Carbon;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function prettyName()
	{
		return ucwords($this->firstname . ' ' . $this->lastname);
	}

	public function slugName()
	{
		$name = $this->firstname.'.'.$this->lastname;

		return strtolower($name);
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

	public function prettyCompleteRole()
	{
		switch ( $this->role ) {
			case 1:
				return 'Admin';
			case 2:
				return 'Household Head';
			default:
				return 'Household Member';
		}
	}

	public function prettyGender()
	{
		return ucfirst($this->gender);
	}

	public function dateRegistered()
	{
		return Carbon::parse($this->activated_at)->format('M d Y');
	}

} 