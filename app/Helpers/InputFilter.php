<?php namespace App\Helpers;

class InputFilter {

	public static function mobileNumber($mobileNo)
	{
		$pattern = '([\(\)\s\-]+)';

		return preg_replace($pattern, '', $mobileNo);
	}

} 