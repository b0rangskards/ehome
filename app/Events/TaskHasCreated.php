<?php

namespace App\Events;

use App\Events\Event;
use App\Notification;
use App\Task;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskHasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

	public $task;
	public $notification;

	/**
	 * Create a new event instance.
	 *
	 * @param Task $task
	 * @param Notification $notification
	 * @return \App\Events\TaskHasCreated
	 */
    public function __construct(Task $task, Notification $notification)
    {
	    $this->task = $task;
	    $this->notification = $notification->getTransformedData();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
	    $channel = [];

	    foreach($this->task->members as $member) {
			$channel[] = $member->getChannel();
	    }

        return $channel;
    }
}
