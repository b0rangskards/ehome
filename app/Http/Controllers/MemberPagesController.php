<?php  namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MemberPagesController extends Controller{


	function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('members.index');
	}

} 