<?php  namespace App\Notifications; 

use App\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Collection;
use Log;

class NotificationHandler {

	public $notification;

	/**
	 * Upon instantiation of notification
	 * only title and link is filled.
	 *
	 * @param Notification $notification
	 */
	function __construct(Notification $notification)
	{
		$this->notification = $notification;
	}


	/**
	 * Notify array of Users
	 *
	 * @param Collection $members
	 * @param $senderId
	 * @param ShouldBroadcast $event
	 */
	public function notifyMembers(Collection $members, $senderId, ShouldBroadcast $event)
	{
		foreach($members as $user) {
			$this->notification
				->addSender($senderId)
				->addRecipient($user->id)
				->send();
		}

		Log::info($this->notification->toArray());

		$this->notify($event);
	}

	public function notify(ShouldBroadcast $event)
	{
		//dispatch event
		event($event);
		//send sms
		//send gcm

		//send web pusher
	}


} 