<?php  namespace App\Helpers; 


use Illuminate\Http\Request;

class RequestHelper {

	public static function isAndroid(Request $request)
	{
		return $request->header('User-Agent') === 'okhttp/2.2.0';
	}

} 