<?php

namespace App\Handlers\Events;

use App\Events\TaskHasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTaskMembers
{

	/**
	 * Create the event handler.
	 *
	 * @return \App\Handlers\Events\NotifyTaskMembers
	 */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskHasCreated  $event
     * @return void
     */
    public function handle(TaskHasCreated $event)
    {
        //
    }
}
