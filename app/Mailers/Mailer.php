<?php namespace App\Mailers;


use Mail;

abstract class Mailer {

	/**
	 * @param $user
	 * @param $subject
	 * @param $view
	 * @param $data
	 */
	public function sendTo($user, $subject, $view, $data = [])
	{
		Mail::queue($view, $data, function ($message) use ($user, $subject) {
			$message->to($user->email)->subject($subject);
		});
	}

} 