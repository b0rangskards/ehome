<?php

namespace App\Events;

use App\Events\Event;
use App\Notification;
use App\Task;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskHasNotice extends Event implements ShouldBroadcast
{
    use SerializesModels;
	/**
	 * @var Task
	 */
	public $task;
	/**
	 * @var Notification
	 */
	public $notification;

	/**
	 * Create a new event instance.
	 *
	 * @param Task $task
	 * @param Notification $notification
	 * @return \App\Events\TaskHasNotice
	 */
    public function __construct(Task $task, Notification $notification)
    {
	    $this->task = $task;
	    $this->notification = $notification;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
	    $channel = [];

	    foreach ( $this->task->members as $member ) {
		    $channel[] = $member->getChannel();
	    }

	    return $channel;
    }
}
