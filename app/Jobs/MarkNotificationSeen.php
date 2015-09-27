<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Notification;
use Illuminate\Contracts\Bus\SelfHandling;

class MarkNotificationSeen extends Job implements SelfHandling
{

	protected $id;

	function __construct($id)
	{
		$this->id = $id;
	}


	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    return Notification::markSeen($this->id);
    }
}
