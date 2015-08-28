<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateAccountJob extends Job implements SelfHandling
{
	protected $id, $firstname, $lastname, $middleinitial,
			  $gender, $email, $mobile_no;

	/**
	 * Create a new job instance.
	 *
	 * @param $id
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $email
	 * @param $mobile_no
	 * @return \App\Jobs\UpdateAccountJob
	 */
	function __construct($id, $firstname, $lastname, $middleinitial, $gender, $email, $mobile_no)
	{
		$this->id = $id;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->middleinitial = $middleinitial;
		$this->gender = $gender;
		$this->email = $email;
		$this->mobile_no = $mobile_no;
	}


	/**
	 * Execute the job.
	 *
	 * @param UserRepository $repository
	 * @return void
	 */
    public function handle(UserRepository $repository)
    {
        $user = User::updateUser(
	        $this->id,
	        $this->firstname,
	        $this->lastname,
	        $this->middleinitial,
	        $this->gender,
	        $this->email,
	        $this->mobile_no
        );

	    $repository->save($user);
    }
}
