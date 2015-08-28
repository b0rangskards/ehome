<?php

namespace App\Handlers\Events;

use App\Events\UserHasActivated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class InitializeFreeTrial
{

	/**
	 * Create the event handler.
	 *
	 * @return \App\Handlers\Events\InitializeFreeTrial
	 */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasActivated  $event
     * @return void
     */
    public function handle(UserHasActivated $event)
    {
	    Log::info('initialize free trial for ');
	    Log::info($event->user);

    }
}
