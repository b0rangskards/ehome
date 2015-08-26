<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class RegisterUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	        'firstname' => 'required|max:100',
	        'lastname' => 'required|max:100',
	        'middleinitial' => 'max:1',
	        'gender' => 'required|max:6',
	        'mobile_no' => 'max:20',
	        'email' => 'required|email|max:255|unique:users'
        ];
    }

	protected  function getValidatorInstance()
	{
		$validator = parent::getValidatorInstance();

		$validator->after(function() use ($validator) {
			$input = $this->input();

			 if( User::isNameExist($input['firstname'], $input['lastname'], $input['middleinitial']))
			 {
				$validator->errors()->add('firstname', "User named {$input['firstname']} {$input['lastname']} already exists.");
			 }
			// add validation for contact_no
		});

		return $validator;
	}
}
