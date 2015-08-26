<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetupHouseholdRequest;
use App\Jobs\SetupHouseholdJob;
use App\Jobs\UpdateHouseholdJob;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Log;
use Response;

class HouseholdsController extends Controller
{
	protected $redirectPath = '/household';

	function __construct()
	{
		$this->middleware('auth');

		$this->middleware('is.householdhead', ['except' => ['index']]);

		$this->middleware('household.check', ['except' => ['create', 'store']]);

		parent::__construct();
	}

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $data['breadcrumbPages'] = [
		    ['name' => 'household'],
	    ];

	    $data['household'] = $this->user->household;
	    $data['householdHead'] = $this->user->household->head;

        return view('members.households.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		$this->hasSetupHousehold();

	    $breadcrumbPages = [
		    ['name' => 'household'],
		    ['name' => 'setup']
	    ];

	    return view('members.households.setup', compact('breadcrumbPages'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param SetupHouseholdRequest $request
	 * @return Response
	 */
    public function store(SetupHouseholdRequest $request)
    {
	    $this->hasSetupHousehold();

	    if( $request->ajax() && !$request->has('head_id') && is_null($request->input('head_id')) ) {
	        return Response::json(['message' => 'You must be registered to continue.'], 422);
	    }

	    // add extra param head id
	    if(!$request->has('head_id')){
		    $request->merge(['head_id' => $this->user->id]);
	    }

        $this->dispatchFrom(SetupHouseholdJob::class, $request);

	    Flash::message('Successfully setup your household. You may now add members.');

		return redirect($this->redirectPath);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param $household
	 * @return Response
	 */
    public function show($household)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $household
	 * @return Response
	 */
    public function edit($household)
    {
        return view('members.households.edit', compact('household'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param SetupHouseholdRequest $request
	 * @param $household
	 * @return Response
	 */
    public function update(SetupHouseholdRequest $request, $household)
    {
	    if ( $request->ajax() &&
		    !$request->has('household_id') &&
		    is_null($request->input('household_id')) )
	    {
		    return Response::json(['message' => 'Must have a Household to continue.'], 422);
	    }

		if ( !$request->ajax()) $request->merge(['household_id' => $household->id]);

	    $this->dispatchFrom(UpdateHouseholdJob::class, $request);

//	    Flash::message('Successfully updated household.');

	    return redirect($this->redirectPath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

	private function hasSetupHousehold()
	{
		if ( !is_null($this->user->household) ) {
			return redirect(route('household.index'));
		}
	}

}


