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
			  $mobile_no, $email;

	/**
	 * Create a new job instance.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $mobile_no
	 * @param $email
	 */
	function __construct($firstname, $lastname, $middleinitial, $gender, $mobile_no, $email)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->middleinitial = $middleinitial;
		$this->gender = $gender;
		$this->mobile_no = $mobile_no;
		$this->email = $email;
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
		    $this->email
	    );

		$repository->save($user);

		event(new UserHasRegistered($user));
    }
}
