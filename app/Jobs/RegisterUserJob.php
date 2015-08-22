<?php

namespace App\Jobs;

use App\Events\UserHasRegistered;
use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Event;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

class RegisterUserJob extends Job implements SelfHandling
{

	protected $firstname, $lastname, $middleinitial, $gender,
			  $mobile_no, $email, $password;

	/**
	 * Create a new job instance.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $mobile_no
	 * @param $email
	 * @param $password
	 */
	function __construct($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email, $password)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->middleinitial = $middleinitial;
		$this->gender = $gender;
		$this->mobile_no = $mobile_no;
		$this->email = $email;
		$this->password = $password;
	}


	/**
	 * Execute the job.
	 *
	 * @param UserRepository $repository
	 * @return void
	 */
    public function handle(UserRepository $repository)
    {
	    $user = User::registerHouseholdHead(
		    $this->firstname,
		    $this->lastname,
		    $this->middleinitial,
		    $this->gender,
		    $this->mobile_no,
		    $this->email,
		    $this->password
	    );

		$repository->save($user);

		event(new UserHasRegistered($user));
    }
}
