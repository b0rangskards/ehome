<?php

namespace App\Handlers\Events;

use App\Events\TaskHasCreated;
use App\Facades\Sms;
use App\Task;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTaskMembers
{
	protected $task;

	/**
	 * Handle the event.
	 *
	 * @param TaskHasCreated $event
	 * @return void
	 */
    public function handle(TaskHasCreated $event)
    {
	    if(env('TEST_MODE', false)) return true;

	    $this->task = Task::findOrFail($event->task->id);

	    // send sms to task members
	    $membersWithSms = $this->task->membersWithSms();

	    $message = $this->task->smsCreateMessage();

	    foreach($membersWithSms as $member){
			SMS::send($message, $member->mobile_no);
		}

    }
}
