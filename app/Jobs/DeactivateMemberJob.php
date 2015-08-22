<?php

namespace App\Jobs;

use App\HouseholdMember;
use App\Jobs\Job;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Log;

class DeactivateMemberJob extends Job implements SelfHandling
{
	protected $member;

	function __construct(HouseholdMember $member)
	{
		$this->member = $member;
	}


	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Soft Delete User
	    $this->member->delete();

	    // Soft Delete HouseholdMember
	    $user = User::deactivateUser($this->member->user_id);
    }
}
