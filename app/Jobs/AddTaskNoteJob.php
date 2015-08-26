<?php

namespace App\Jobs;

use App\Events\NewTaskNoteHasCreated;
use App\Jobs\Job;
use App\Repositories\TaskNoteRepository;
use App\TaskNote;
use Illuminate\Contracts\Bus\SelfHandling;

class AddTaskNoteJob extends Job implements SelfHandling
{
	protected $user_id, $task_id, $note;

	/**
	 * Create a new job instance.
	 *
	 * @param $user_id
	 * @param $note
	 * @param $task_id
	 * @return \App\Jobs\AddTaskNoteJob
	 */
	function __construct($user_id, $note, $task_id)
	{
		$this->user_id = $user_id;
		$this->note = $note;
		$this->task_id = $task_id;
	}


	/**
	 * Execute the job.
	 *
	 * @param TaskNoteRepository $repository
	 * @return void
	 */
    public function handle(TaskNoteRepository $repository)
    {
	    $note = TaskNote::newNote(
		    $this->user_id,
		    $this->task_id,
		    $this->note
	    );

	    $repository->save($note);

	    $transformedNote = $note->getTransformedData();

	    // event here to notify task members and task creator
		event(new NewTaskNoteHasCreated($note, $transformedNote));

	    return $transformedNote;
    }
}
