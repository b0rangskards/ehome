<?php  namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Carbon;
use Log;
use Response;

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
		$data['users'] = UserRepository::getTableDataWithTrash();

		return view('admin.users.index', $data);
	}

	public function banUser($user)
	{
		$user->banned_date = Carbon::now();
		$user->save();
		$user->delete();
		return Response::json();
	}

	public function revokeBan($user)
	{
		Log::info('revoke ban');
//		$user->banned_date = NULL;
//		$user->save();
//		$user->restore();
		return Response::json();
	}

} 