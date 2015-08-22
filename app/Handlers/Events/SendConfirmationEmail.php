<?php

namespace App\Handlers\Events;

use App\Events\UserHasRegistered;
use App\Mailers\UserMailer;

class SendConfirmationEmail
{
	protected $mailer;

	/**
	 * @param UserMailer $mailer
	 */
	function __construct(UserMailer $mailer)
	{
		$this->mailer = $mailer;
	}


	/**
	 * Handle the event.
	 *
	 * @param  UserHasRegistered $event
	 * @return void
	 */
    public function handle(UserHasRegistered $event)
    {
	    // Send Confirmation Email to User
	    $this->mailer->sendConfirmationMessageTo($event->user);
    }
}
