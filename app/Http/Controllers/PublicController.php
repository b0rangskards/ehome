<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
	function __construct()
	{
		$this->middleware('guest', ['except' => 'showErrorPage']);
	}

	public function showLandingPage()
    {
	    return view('public.index');
    }

	public function showErrorPage()
	{
		return view('public.error');
	}
}
