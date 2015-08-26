<?php  namespace App\Presenters; 

use Carbon;
use Laracasts\Presenter\Presenter;

class TaskNotePresenter extends Presenter {

	public function prettyNote()
	{
		return ucwords($this->note);
	}

	public function informalSentDate()
	{
		return Carbon::parse($this->created_at)->diffForHumans();
	}


} 