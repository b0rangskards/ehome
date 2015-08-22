<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class ActivateAccountJob extends Job implements SelfHandling
{

	/**
	 * @var User
	 */
	private $user;

	/**
	 * Create a new job instance.
	 *
	 * @param User $user
	 * @return \App\Jobs\ActivateAccountJob
	 */
    public function __construct(User $user)
    {
	    $this->user = $user;
    }

	/**
	 * Execute the job.
	 *
	 * @param UserRepository $repository
	 * @return void
	 */
    public function handle(UserRepository $repository)
    {
        $user = $this->user->activateAccount();

        $repository->save($user);
    }
}
