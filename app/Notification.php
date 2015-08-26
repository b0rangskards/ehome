<?php

namespace App;

use App\Helpers\TaskHelper;
use App\Transformers\NotificationTransformer;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Log;

class Notification extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\NotificationPresenter';

	protected $table = 'notifications';

	protected $fillable = ['from_userid', 'to_userid', 'title', 'seen', 'link'];

	public static function newNotification($from_userid, $to_userid, $title, $link = null)
	{
		return new static(compact('from_userid', 'to_userid', 'title', 'link'));
	}

   public static function newTaskNote(TaskNote $note, $taskMembers)
   {
	   $notification = null;

	   $noteMessage = TaskHelper::newTaskNoteNotification($note);
	   $noteLink = TaskHelper::createNotificationLink($note->task->id);

	   foreach($taskMembers as $member)
	   {
		   $notification = static::newNotification(
			                  $note->user_id,
			                  $member->id,
			                  $noteMessage,
			                  $noteLink
		                    );
		   $notification->save();
	   }

	   return $notification;
   }

	public static function createTaskUpdated(Task $task, $from_userid)
	{
		return static::create([
			'title' => TaskHelper::createNotificationForTaskUpdated($task->present()->prettyStatus, $task->present()->prettyName),
			'to_userid' => $task->household->head->id,
			'from_userid' => $from_userid,
			'link' => TaskHelper::createNotificationLink($task->id)
		]);
	}

	public static function createFromTask(Task $task)
	{
		$notification = null;
		$title = TaskHelper::createNotificationTitle($task->name);
		$link = TaskHelper::createNotificationLink($task->id);
		$from_userid = $task->household->head_id;

		//get members
		foreach($task->members as $member) {
			$notification = static::newNotification(
				$from_userid,
				$member->id,
				$title,
				$link
			);
			// persist
			$notification->save();
		}

		if( !$task->isSubtask()) static::createFromSubtasks($task);

		return $notification;
	}

	public static function createFromSubtasks(Task $task)
	{
		if ( !$task->hasSubtask() ) return false;

		foreach($task->subtasks as $subtask)
		{
			static::createFromTask($subtask);
		}
	}

	public function getTransformedData()
	{
		$transformer = new NotificationTransformer;

		return $transformer->transform($this);
	}

	public static function markSeen($recipientId, $link)
	{
		$notification = Notification::where('link', $link)
							->where('to_userid', $recipientId)
							->first();

		if (!$notification) return false;

		$notification->seen = 1;

		return $notification->save();
	}

	public function sender()
	{
		return $this->belongsTo('App\User', 'from_userid');
	}

	public function recipient()
	{
		return $this->belongsTo('App\User', 'to_userid');
	}

}
