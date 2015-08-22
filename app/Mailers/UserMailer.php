<?php  namespace App\Mailers; 

use App\User;

class UserMailer extends Mailer {

	public function sendConfirmationMessageTo(User $user)
	{
		$subject = 'Welcome to eHome!';

		$view = 'emails.registration.confirm';

		$link = route('auth.register.activate', $user->activation_code);

		return $this->sendTo($user, $subject, $view, ['link' => $link]);
	}

} 