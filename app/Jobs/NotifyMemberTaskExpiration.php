<?php

namespace App\Jobs;

use App\Events\TaskHasNotice;
use App\Jobs\Job;
use App\Notification;
use App\Notifications\NotificationHandler;
use App\Task;
use Illuminate\Contracts\Bus\SelfHandling;

class NotifyMemberTaskExpiration extends Job implements SelfHandling
{
	public $activeTasks;

	/**
	 * Create a new job instance.
	 *
	 * @param $activeTasks
	 * @return \App\Jobs\NotifyMemberTaskExpiration
	 */
    public function __construct($activeTasks)
    {
        //get all the tasks that hasnt expired
	    $this->activeTasks = $activeTasks;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $notificationHandler = null;
	    // Notify all Task Members
        foreach($this->activeTasks as $task) {
			$notification = Notification::notifyTaskExpiration($task);
	        $notificationHandler = new NotificationHandler($notification);
	        $notificationHandler->notifyMembers(
		                            $task->members,
		                            $task->household->head->id,
	                                new TaskHasNotice($task, $notification)
	                            );
        }
    }
}
