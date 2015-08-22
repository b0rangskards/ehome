<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $redirectPath = '/home';

	protected $redirectAdminPath = '/admin/dashboard';

	protected $redirectAfterLogout = '/auth/login';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return \App\Http\Controllers\Auth\AuthController
	 */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

}
