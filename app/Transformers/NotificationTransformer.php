<?php  namespace App\Transformers; 

class NotificationTransformer extends Transformer {

	public function transform($notification)
	{
		return [
			'title' => $notification->present()->prettyTitle,
			'seen' => (boolean) $notification->seen,
			'link' => $notification->link,
			'timeSent' => $notification->present()->informalSentDate(),
			'created_at' => $notification->created_at,
			'senderName' => $notification->sender->present()->prettyName,
			'senderId' => $notification->from_userid,
			'recipientName' => $notification->recipient->present()->prettyName,
			'recipientId' => $notification->to_userid
		];
	}
}