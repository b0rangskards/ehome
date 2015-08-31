<?php

namespace App\Handlers\Events;

use App\Events\UserHasActivated;
use App\Subscription;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class RegisterFreeTrial
{

	public $user;

	/**
	 * Create the event handler.
	 *
	 * @return \App\Handlers\Events\RegisterFreeTrial
	 */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasActivated  $event
     * @return void
     */
    public function handle(UserHasActivated $event)
    {
	    $this->user = User::findOrFail($event->user->id);

		$subscription = Subscription::registerFreeTrial($this->user->id);

	    Log::info('Register Free Trial For User: '.$this->user->email);
    }
}
