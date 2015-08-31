<?php  namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UsersController extends Controller {


	function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data['breadcrumbPages'] = [
			['name' => 'users']
		];

		$data['tableHeader'] = UserRepository::getTableHeader();
		$data['users'] = UserRepository::getTableData();

		return view('admin.users.index', $data);
	}

} 