<?php

namespace App\Events;

use App\Events\Event;
use App\Notification;
use App\Task;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskStatusUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;

	public $task;
	public $notification;

	/**
	 * Create a new event instance.
	 *
	 * @param Task $task
	 * @param $from_userid
	 * @return \App\Events\TaskStatusUpdated
	 */
    public function __construct(Task $task, $from_userid)
    {
	    $this->task = $task;
	    $this->notification = Notification::createTaskUpdated($task, $from_userid)->getTransformedData();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
	    // Channel is the household head user id
        return [$this->task->household->head->getChannel()];
    }
}
