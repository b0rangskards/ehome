<?php  namespace App\Notifications; 

use App\Task;

class NotificationMessageBuilder {

	public static function taskExpiration(Task $task)
	{
		$minutesLeft = $task->timeLeft();

		return [
			'title' => "You have {$minutesLeft} left. Task \"{$task->present()->prettyName}\" will expire {$task->present()->informalDeadline}",
			'link' => route('task.show', $task->id)
		];
	}
} 