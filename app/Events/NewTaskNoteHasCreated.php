<?php

namespace App\Events;

use App\Events\Event;
use App\Notification;
use App\TaskNote;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Log;

class NewTaskNoteHasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

	public $note;

	public $notification;

	private $rawNote;

	private $taskMembers;

	/**
	 * Create a new event instance.
	 *
	 * @param TaskNote $note
	 * @param $transformedNote
	 * @return \App\Events\NewTaskNoteHasCreated
	 */
    public function __construct(TaskNote $note, $transformedNote)
    {
        $this->note = $transformedNote;

		$this->rawNote = $note;

	    $this->taskMembers = $this->rawNote->task->getMembers($this->rawNote->user_id);

	    $this->notification = Notification::newTaskNote($note, $this->taskMembers)->getTransformedData();

	    Log::info($this->getChannel());
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return $this->getChannel();
    }

	private function getChannel()
	{
		$channel = [];
		foreach ( $this->taskMembers as $member ) {
			$channel[] = $member->getChannel();
		}
		return $channel;
	}
}
