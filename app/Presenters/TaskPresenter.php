<?php  namespace App\Presenters; 

use Carbon;
use Laracasts\Presenter\Presenter;

class TaskPresenter extends Presenter {

	public function prettyName()
	{
		return ucwords($this->name);
	}

	public function prettyDescription()
	{
		return ucwords($this->description);
	}

	public function prettyStatus()
	{
		return str_replace('_', ' ', ucwords($this->status));
	}

	public function prettyRecurringAt()
	{
		return ucwords($this->recurring_at);
	}

	public function informalDeadline()
	{
		return Carbon::parse($this->due_at)->diffForHumans();
	}
} 