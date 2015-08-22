<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Jobs\CreateTaskJob;
use App\TaskType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Response;

class TasksController extends Controller
{

	protected $redirectPath = '/task';


	function __construct()
	{
		$this->middleware('auth');

		// create a filter for head only
		// only household heads allowed to create,update, and delete task

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
		    ['name' => 'task'],
	    ];

        return view('members.tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
	    $data['breadcrumbPages'] = [
		    ['name' => 'task', 'link' => route('task.index')],
		    ['name' => 'create task']
	    ];

	    $data['taskTypes'] = TaskType::lists('name', 'id');
	    $data['taskMembers'] = $this->user->household->getHouseholdMembers($this->user->id);

	    return view('members.tasks.create', $data);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateTaskRequest $request
	 * @return Response
	 */
    public function store(CreateTaskRequest $request)
    {
	    if ( $request->ajax() && !$request->has('household_id') && is_null($request->input('household_id')) ) {
		    return Response::json(['message' => 'You must have a household to create task.'], 422);
	    }

	    if ( !$request->has('household_id') ) {
		    $request->merge(['household_id' => $this->user->household->id]);
	    }

	    $this->dispatchFrom(CreateTaskJob::class, $request);

	    Flash::message('Successfully created task.');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
