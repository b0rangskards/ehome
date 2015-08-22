<?php  namespace App\Validators; 

use Validator;

class CoordinatesValidator extends Validator {

	public function validate($attribute, $value)
	{
		$pattern = '/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/';

		return preg_match($pattern, $value);
	}

} 