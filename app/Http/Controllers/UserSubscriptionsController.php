<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserSubscriptionsController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');

		$this->middleware('must.be.head');

		parent::__construct();
	}

	public function index()
    {
        return view('members.subscriptions.index');
    }

}
