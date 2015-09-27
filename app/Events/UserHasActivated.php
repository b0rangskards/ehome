<?php

namespace App\Events;

use App\Events\Event;
use App\Notification;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasActivated extends Event implements ShouldBroadcast
{
    use SerializesModels;
	/**
	 * @var User
	 */
	public $user;
	public $notification;

	/**
	 * Create a new event instance.
	 *
	 * @param User $user
	 * @return \App\Events\UserHasActivated
	 */
    public function __construct(User $user)
    {
	    $this->user = $user;
	    $this->notification = Notification::createUserHasActivated($user)->getTransformedData();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
	    if($this->user->isMember()) {
		    return [$this->user->household->head->getChannel()];
	    }

	    return UserRepository::getAllAdminChannels();
    }
}
