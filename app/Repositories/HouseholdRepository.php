<?php  namespace App\Repositories; 

use App\Household;

class HouseholdRepository implements RepositoryInterface {

	public function save(Household $household)
	{
		return $household->save();
	}
} 