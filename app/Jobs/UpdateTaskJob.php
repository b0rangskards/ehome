<?php

namespace App\Jobs;

use App\Events\TaskHasUpdated;
use App\Helpers\FileHelper;
use App\Jobs\Job;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Contracts\Bus\SelfHandling;
use Input;
use Log;

class UpdateTaskJob extends Job implements SelfHandling
{

	protected $id, $name, $due_at, $recurring_at, $priority,
			  $task_members, $description, $coordinates;

	/**
	 * Create a new job instance.
	 *
	 * @param $id
	 * @param $name
	 * @param $due_at
	 * @param $recurring_at
	 * @param $priority
	 * @param $task_members
	 * @param $description
	 * @param $coordinates
	 */
	function __construct($id, $name, $due_at, $recurring_at, $priority, $task_members, $description, $coordinates)
	{
		$this->id = $id;
		$this->name = $name;
		$this->due_at = $due_at;
		$this->recurring_at = $recurring_at;
		$this->priority = $priority;
		$this->task_members = $task_members;
		$this->description = $description;
		$this->coordinates = $coordinates;
	}


	/**
	 * Execute the job.
	 *
	 * @param TaskRepository $repository
	 * @return void
	 */
    public function handle(TaskRepository $repository)
    {
        $task = Task::updateTask(
			$this->id,
			$this->name,
			$this->due_at,
			$this->recurring_at,
			$this->priority,
			$this->description,
			$this->coordinates
        );

	    // Save image if any...
	    if ( Input::hasFile('image') ) {
		    // delete old image
			$task->deleteOldImage();

		    $file = Input::file('image');
		    $fileName = FileHelper::uploadImage($task->name, $task->household_id, $file->getRealPath(), $file->getClientOriginalExtension());

		    $task->image = $fileName;
	    }

	    // persist
	    $repository->save($task, $this->task_members);

	    //fire event
	    event(new TaskHasUpdated($task));
    }
}
