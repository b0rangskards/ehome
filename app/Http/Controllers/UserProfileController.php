<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Jobs\UpdateAccountJob;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class UserProfileController extends Controller
{
	protected $redirectRoute = 'profile.index';

	function __construct()
	{
		$this->middleware('auth');

		parent::__construct();
	}

	public function index($currentUser)
    {
		return view('profile.index');
    }

	public function edit($user)
	{
		$data['breadcrumbPages'] = [
			['name' => 'profile', 'link' => route('profile.index')],
			['name' => 'edit']
		];

		$data['user'] = $user;

		return view('profile.edit', $data);
	}

	/**
	 * @param UpdateAccountRequest $request
	 * @param $user
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(UpdateAccountRequest $request, $user)
	{
		$request->merge(['id' => $user->id]);

		$this->dispatchFrom(UpdateAccountJob::class, $request);

		Flash::message('Successfully updated your account.');

		return redirect(route($this->redirectRoute, $user->present()->slugName));
	}

	public function getSettings($currentUser)
	{
		$data['breadcrumbPages'] = [
			['name' => 'profile', 'link' => route('profile.index')],
			['name' => 'settings']
		];

		return view('profile.settings', $data);
	}

	public function deactivate($user)
	{
		User::deactivateUser($user->id);

		Auth::logout();

		Flash::message('Account Deactivated.');

		return redirect(route('auth.login'));
	}
}
