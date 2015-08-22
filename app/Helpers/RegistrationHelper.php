<?php  namespace App\Helpers; 

class RegistrationHelper {

	public static function generateActivationCode()
	{
		return str_random(30);
	}

	public static function generateRandomPassword()
	{
		return str_random(10);
	}

} 