<?php  namespace App\Validators; 

use Input;
use Validator;

class EmptyWhenValidator extends Validator {

	/*
	 * Custom Validation
	 * The field under validation must be empty when these fields aren't.
	 *
	 * empty_when:field,field2,...
	 */
	public function validate($attribute, $value, $parameters)
	{
		foreach ( $parameters as $key ) {
			if ( !empty(Input::get($key)) ) {
				return false;
			}
		}
		return true;
	}
} 