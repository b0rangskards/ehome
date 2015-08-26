<?php  namespace App\Presenters; 

use Carbon;
use Laracasts\Presenter\Presenter;

class NotificationPresenter extends Presenter {

	public function prettyTitle()
	{
		return ucwords($this->title);
	}

	public function informalSentDate()
	{
		return Carbon::parse($this->created_at)->diffForHumans();
	}

} 