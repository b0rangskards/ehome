<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use Response;

class NotificationsController extends Controller
{
	public function index()
	{
		$data['breadcrumbPages'] = [
			['name' => 'notifications'],
		];

		$data['notifications'] = $this->user->notifications()->paginate(10);

		return view('notifications.index', $data);
	}

    public function markSeen(Request $request)
    {
	    $markSeen = Notification::markSeen($request->input('to_userid'), $request->input('link'));

	    if(!boolval($markSeen)) {
	        return Response::json(['message' => 'Problem processing your request.'], 422);
        }

	    return Response::json();
    }
}
