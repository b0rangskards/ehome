<?php

namespace App\Jobs;

use App\Household;
use App\Jobs\Job;
use App\Repositories\HouseholdRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateHouseholdJob extends Job implements SelfHandling
{
	protected $household_id;
	protected $address;
	protected $coordinates;

	/**
	 * Create a new job instance.
	 *
	 * @param $household
	 * @param $address
	 * @param $coordinates
	 * @return \App\Jobs\UpdateHouseholdJob
	 */
	function __construct($household_id, $address, $coordinates)
	{
		$this->address = $address;
		$this->coordinates = $coordinates;
		$this->household_id = $household_id;
	}


	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle(HouseholdRepository $repository)
    {
	    // persist
	    $household = Household::updateHousehold(
		    $this->household_id,
		    $this->address,
		    $this->coordinates
	    );

	    $repository->save($household);
    }
}
