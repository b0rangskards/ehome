<?php

namespace App\Jobs;

use App\Events\NewHouseholdMemberHasBeenAdded;
use App\Events\UserHasRegistered;
use App\Household;
use App\HouseholdMember;
use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class AddNewHouseholdMemberJob extends Job implements SelfHandling
{

	protected $firstname, $lastname, $middleinitial, $gender,
		$mobile_no, $email;

	protected $household_id;

	/**
	 * Create a new job instance.
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $middleinitial
	 * @param $gender
	 * @param $email
	 * @param $mobile_no
	 * @param $household_id
	 * @return \App\Jobs\AddNewHouseholdMemberJob
	 */
	function __construct($firstname, $lastname, $middleinitial, $gender, $email, $mobile_no, $household_id)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->middleinitial = $middleinitial;
		$this->gender = $gender;
		$this->email = $email;
		$this->mobile_no = $mobile_no;
		$this->household_id = $household_id;
	}


	/**
	 * Execute the job.
	 *
	 * @param UserRepository $repository
	 * @return void
	 */
    public function handle(UserRepository $repository)
    {
        $person = User::addHouseholdMember(
	        $this->firstname,
	        $this->lastname,
	        $this->middleinitial,
	        $this->gender,
	        $this->mobile_no,
	        $this->email
        );

	    $repository->save($person);

	    $member = HouseholdMember::addMember($this->household_id, $person->id);

	    $household = Household::findOrFail($this->household_id);

	    $household->members()->save($member);

	    event(new UserHasRegistered($person));
    }
}
