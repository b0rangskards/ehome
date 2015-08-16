<?php

namespace App\Commands;




use App\Jobs\Job;

class RegisterUserCommand extends Job
{
	protected $firstname;

	protected $lastname;

	function __construct($firstname, $lastname)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
	}

}
