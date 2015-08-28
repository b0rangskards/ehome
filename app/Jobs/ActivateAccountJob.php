<?php

namespace App\Jobs;

use App\Events\UserHasActivated;
use App\Jobs\Job;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class ActivateAccountJob extends Job implements SelfHandling
{

	/**
	 * @var User
	 */
	protected $user;

	protected $password;

	/**
	 * Create a new job instance.
	 *
	 * @param User $user
	 * @param $password
	 * @return \App\Jobs\ActivateAccountJob
	 */
    public function __construct(User $user, $password)
    {
	    $this->user = $user;
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
        $user = $this->user->activateAccount($this->password);

        $repository->save($user);

	    event(new UserHasActivated($user));
    }
}
