<?php  namespace App\Helpers; 

use App\Task;
use App\TaskNote;

class TaskHelper {

	public static function createUpdatedTaskNotificationTitle($taskName)
	{
		return "Task has been updated: \"$taskName\"";
	}

	public static function newTaskNoteNotification(TaskNote $note)
	{
		return "New Note: \"{$note->present()->prettyNote}\" \n from task \"{$note->task->present()->prettyName}\"";
	}

	public static function createNotificationTitle($taskName)
	{
		return "You have a new task: \"$taskName\"";
	}

	public static function createNotificationLink($taskId)
	{
		return route('task.show', $taskId);
	}

	public static function createNotificationForTaskUpdated($status, $title)
	{
		return "Task status updated to \"{$status}\". \"{$title}\"";
	}

} 