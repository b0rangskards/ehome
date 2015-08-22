<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewHouseholdMemberRequest;
use App\Jobs\AddNewHouseholdMemberJob;
use App\Jobs\DeactivateMemberJob;
use App\Jobs\UpdateHouseholdMemberJob;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Log;
use Response;

class HouseholdMembersController extends Controller
{
	protected $redirectPath = '/household';

	function __construct()
	{
		$this->middleware('auth');

		$this->middleware('household.check');
	}

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($household)
    {
	    $breadcrumbPages = [
		    ['name' => 'household', 'link' => route('household.index')],
		    ['name' => 'member']
	    ];

	    return view('members.household-members.index', compact('breadcrumbPages', 'household'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
	    $breadcrumbPages = [
		    ['name' => 'household', 'link' => route('household.index')],
		    ['name' => 'member']
	    ];

        return view('members.household-members.create', compact('breadcrumbPages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AddNewHouseholdMemberRequest $request, $household)
    {
	    // add extra param head id
	    if ( !$request->has('household_id') ) {
		    $request->merge(['household_id' => $household]);
	    }

	    $this->dispatchFrom(AddNewHouseholdMemberJob::class, $request);

	    Flash::message('Successfully added member. However it requires activation on his/her email account.');

	    return redirect($this->redirectPath);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($household, $member)
    {
	    $data['breadcrumbPages'] = [
		    ['name' => 'household', 'link' => route('household.index')],
		    ['name' => 'member']
	    ];
	    $data['member'] = $member;

	    return view('members.household-members.edit', $data);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request $request
	 * @param $household
	 * @param $member
	 * @return Response
	 */
    public function update(Request $request, $household, $member)
    {
        $this->validate($request, $this->validators($member->user_id));

	    $request->merge(['user_id' => $member->user_id]);

	    $this->dispatchFrom(UpdateHouseholdMemberJob::class, $request);

	    return redirect(route('household.member.index', $household->id));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $household
	 * @param $member
	 * @return Response
	 */
    public function destroy($household, $member)
    {
	    $this->dispatch(new DeactivateMemberJob($member));

	    // return response json
	    // return redirectTo value
	    return Response::json();
    }

	protected function validators($userId)
	{
		return [
			'firstname' => 'required|max:100',
			'lastname' => 'required|max:100',
			'middleinitial' => 'required|max:1',
			'gender' => 'required|max:6',
			'mobile_no' => 'max:20',
			'email' => 'required|email|max:255|unique:users,email,' . $userId
		];
	}
}
