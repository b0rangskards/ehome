<?php

namespace App\Jobs;

use App\Household;
use App\Repositories\HouseholdRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class SetupHouseholdJob extends Job implements SelfHandling
{
	protected $head_id;
	protected $address;
	protected $coordinates;

	/**
	 * Create a new job instance.
	 *
	 * @param $address
	 * @param $coordinates
	 * @return \App\Jobs\SetupHouseholdJob
	 */
    public function __construct($head_id, $address, $coordinates)
    {
	    $this->head_id = $head_id;
	    $this->address = $address;
	    $this->coordinates = $coordinates;
    }

	/**
	 * Execute the job.
	 *
	 * @param HouseholdRepository $repository
	 * @return void
	 */
    public function handle(HouseholdRepository $repository)
    {
        // persist
	    $household = Household::setup(
			$this->head_id,
		    $this->address,
			$this->coordinates
	    );

	    $repository->save($household);
    }
}
