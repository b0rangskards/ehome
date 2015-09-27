<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNoteRequest;
use App\Http\Requests\TaskRequest;
use App\Jobs\AddTaskNoteJob;
use App\Jobs\CreateTaskJob;
use App\Jobs\UpdateTaskJob;
use App\Jobs\UpdateTaskStatusJob;
use App\Task;
use App\User;
use Config;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Redirect;
use Response;

class TasksController extends Controller
{

	protected $redirectPath = '/task';

	function __construct()
	{
		$this->middleware('auth', ['except' => ['getUserTasks']]);

		$this->middleware('household.check', ['except' => ['getUserTasks']]);

		$this->middleware('check.subscription',['only' => ['create', 'store']]);

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

	    $data['tasks'] = $this->user->isHead()
		                ? $this->user->household->tasks()->paginate(Task::$limit)
		                : $this->user->tasks()->paginate(Task::$limit);

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

	    $data['membersList'] = $this->user->household->member_list;

	    return view('members.tasks.create', $data);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param TaskRequest $request
	 * @return Response
	 */
    public function store(TaskRequest $request)
    {
	    if ( $request->ajax() && !$request->has('household_id') && is_null($request->input('household_id')) ) {
		    return Response::json(['message' => 'You must have a household to create task.'], 422);
	    }

	    if ( !$request->has('household_id') ) {
		    $request->merge(['household_id' => $this->user->household->id]);
	    }

	    $this->dispatchFrom(CreateTaskJob::class, $request);

	    Flash::message('Task Created.');

	    return redirect($this->redirectPath);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param $task
	 * @return Response
	 */
    public function show($task)
    {
	    $data['taskNotes'] = $task->notes;
	    $data['task'] = $task;

	    if($task->hasMember($this->user->id))
	    {
		    if( is_null($task->getMember($this->user->id)->pivot->accepted))
		    {
			    return view('members.tasks.confirm', $data);
		    }
		    else if( $task->getMember($this->user->id)->pivot->accepted === 0)
		    {
			    return Redirect::route('task.index');
		    }
	    }

	    return view('members.tasks.show', $data);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $task
	 * @return Response
	 */
    public function edit($task)
    {
	    $data['breadcrumbPages'] = [
		    ['name' => 'task', 'link' => route('task.index')],
		    ['name' => 'edit task']
	    ];

	    $data['task'] = $task;
	    $data['membersList'] = $this->user->household->member_list;

        return view('members.tasks.edit', $data);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param TaskRequest $request
	 * @param $task
	 * @return Response
	 */
    public function update(TaskRequest $request, $task)
    {
	    $request->merge(['id' => $task->id]);

	    $this->dispatchFrom(UpdateTaskJob::class, $request);

	    Flash::message('Task Updated.');

	    return Redirect::route('task.index');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $task
	 * @return Response
	 */
    public function destroy($task)
    {
        $task->deleteOldImage();
	    $task->delete();

		return Response::json(['message' => 'Task Deleted.', 'redirectTo' => route('task.index')], 200);
    }

	public function confirm(Request $request, $task)
	{
		$this->validate($request, [
			'user_id' => 'required|exists:users,id'
		]);

		$accepted = $request->input('confirm')==='accept';

		$task->members()->updateExistingPivot($request->input('user_id'), [
			'accepted' => $accepted
		]);

		$redirectTo = $accepted ? route('task.show', $task->id) : route('task.index');
		$message = $accepted ? 'Task Accepted.' : 'Task Declined.';

		return Response::json(['message' => $message, 'redirectTo' => $redirectTo], 200);
	}

	public function updateStatus(Request $request, $task)
	{
		$status = $request->input('status');
		$from_userid = $request->input('from_userid');
		$statusArray = Config::get('enums.task_status');

		if(!array_key_exists($status, $statusArray)) {
			return Response::json(['message' => 'Task status is invalid'], 422);
		}

		$this->dispatch(new UpdateTaskStatusJob($from_userid, $status, $task));

		return Response::json(['status' => $statusArray[$status]], 200);
	}

	public function addNote(AddNoteRequest $request, $task)
	{
		$request->merge(['task_id' => $task->id]);

		$note = $this->dispatchFrom(AddTaskNoteJob::class, $request);

		return Response::json(['note' => $note], 200);
	}

	public function getUserTasks(User $user)
	{
		return $user->isHead()
			? $user->household->tasks()->get()
			: $user->tasks()->get();
	}

}
