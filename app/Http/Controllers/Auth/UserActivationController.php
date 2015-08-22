<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ActivateAccountJob;
use App\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Validator;

class UserActivationController extends Controller
{

	/**
	 * @param $activationCode
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function activateAccount($activationCode, Request $request)
    {
	    $validator = Validator::make(['activation_code' => $activationCode], [
		    'activation_code' => 'required|exists:users'
	    ]);

	    if($validator->fails()) {
		    return redirect(route('public.error'))
			            ->withErrors($validator);
	    }

	    $user = User::where('activation_code', $activationCode)->first();

	    $this->dispatch(new ActivateAccountJob($user));

	    Flash::success('Your have successfully activated your account. Please login to continue.');

	    return redirect(route('auth.login'));
    }
}
