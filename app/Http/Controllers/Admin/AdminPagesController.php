<?php  namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;

class AdminPagesController extends Controller {

	public function getDashboard()
	{
		return view('admin.index');
	}

} 