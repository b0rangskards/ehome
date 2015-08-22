<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateHouseholdMemberJob extends Job implements SelfHandling
{

	protected $firstname, $lastname, $middleinitial, $gender,
		$mobile_no, $email;

	protected $user_id;

	/**
	 * Create a new job instance.
	 *
	 * @param $user_id
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $email
	 * @param $mobile_no
	 * @internal param $member_id
	 */
	function __construct($user_id, $firstname, $lastname, $middleinitial, $gender, $email, $mobile_no)
	{
		$this->user_id = $user_id;
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
        $person = User::updateHouseholdMember(
	        $this->user_id,
	        $this->firstname,
	        $this->lastname,
	        $this->middleinitial,
	        $this->gender,
	        $this->mobile_no,
	        $this->email
        );

	    $repository->save($person);
    }
}
