<?php  namespace App\Validators; 

use App\User;
use Validator;

class HouseholdMembersValidator extends Validator{

	public function validateMembersExistence($attribute, $value, $parameters)
	{
		foreach ( $value as $memberId ) {
			if ( is_null(User::find($memberId)) ) {
				return false;
			}
		}
		return true;
	}
} 