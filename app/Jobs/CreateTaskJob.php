<?php

namespace App\Jobs;

use App\Events\TaskHasCreated;
use App\Helpers\FileHelper;
use App\Household;
use App\Jobs\Job;
use App\Notification;
use App\Repositories\TaskRepository;
use App\Task;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use Input;
use Intervention\Image\Facades\Image;

class CreateTaskJob extends Job implements SelfHandling
{
	protected $name, $due_at, $recurring_at, $priority,
			  $task_members, $description, $coordinates;

	protected $household_id;

	protected $subtasks;

	protected $repository;

	/**
	 * Create a new job instance.
	 *
	 * @param $household_id
	 * @param $name
	 * @param $due_at
	 * @param $recurring_at
	 * @param $priority
	 * @param $task_members
	 * @param $description
	 * @param $coordinates
	 * @param $subtasks
	 */
	function __construct($household_id, $name, $due_at, $recurring_at,
	                     $priority, $task_members, $description, $coordinates, $subtasks)
	{
		$this->household_id = $household_id;
		$this->name = $name;
		$this->due_at = $due_at;
		$this->recurring_at = $recurring_at;
		$this->priority = $priority;
		$this->task_members = $task_members;
		$this->description = $description;
		$this->coordinates = $coordinates;
		$this->subtasks = $subtasks;
	}

	/*
	 * create a slug for task !done
	 * if has image resize it and !done
	 * save to a directory (need to specify directory first maybe household/id/images) !done
	 * create first task and !done
	 * assign to variable for parent id reference of subtask !done
	 *
	 * get all the user id of members then add !done
	 * add member tasks maybe you can do sync using many to many eloquent !done
	 *
	 * add subtasks !done
	 * get all the numeric index of subtasks form data !done
	 * and treat it as user id !done
	 * and add members !done
	 *
	 * fire an event for taskcreate
	 * an event will send notification to user member
	 *  1. create a notification title for task creation
	 *  2. generate a link to show task
	 *  3. notification record must have from and to userid
	 *     so get the household head id and task member user id
	 *  4. persist notification
	 * an event will send SMS to task members that has sms number
	 *  1. create a sms message prompting the member for new task and a confirmation message for task
	 *      ex. "You have a new task from {$household_head_name}. \n
	 *          {$task_name} \n
	 *          ---------------- \n
	 *          Accept Task? \n
	 *          Reply YES to accept and No to decline task."
	 *  2. maybe persist it in database (need to create table)
	 *  3. send sms
	 */

	/**
	 * Execute the job.
	 *
	 * @param TaskRepository $taskRepository
	 * @return void
	 */
    public function handle(TaskRepository $taskRepository)
    {
	    $this->repository = $taskRepository;

        $task = Task::createTask(
			$this->household_id,
			$this->name,
			$this->due_at,
			$this->recurring_at,
			$this->priority,
			null, // parent id is null for main task
			$this->description,
			$this->coordinates
        );

		// Save image if any...
	    if(Input::hasFile('image'))
	    {
			$file = Input::file('image');
		    $fileName = FileHelper::uploadImage($this->name, $this->household_id, $file->getRealPath(), $file->getClientOriginalExtension());

		    $task->image = $fileName;
	    }

	    // Persist Task
	    $taskRepository->save($task, $this->task_members);

	    // Create Subtask if any...
		$this->createSubtask($this->subtasks, $task);

	    $notification = Notification::createFromTask($task);

	    // Fire event for Task | TODO Send SMS to task members who have mobile number
	    event(new TaskHasCreated($task, $notification));
    }



	private function createSubtask($subtasks, $parentTask)
	{
		foreach( $subtasks as $subtaskArr )
		{
			if ( $subtaskArr['name'] )
			{
				$subtask = Task::createSubtask($parentTask, $subtaskArr);
				// if members is 0 automatically assign it to all members on parent task
				$members = Task::extractMembers($subtaskArr);
				$members = count($members) === 0
					? $parentTask->task_members
					: $members;

				// Persist Subtask
				$this->repository->save($subtask, $members);

				// Fire event for subtask
				// event(new TaskHasCreated($task));
			}
		}
	}


}
