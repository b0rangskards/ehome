<?php

namespace App\Jobs;

use App\Helpers\FileHelper;
use App\Household;
use App\Jobs\Job;
use App\Repositories\TaskRepository;
use App\Task;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use Input;
use Intervention\Image\Facades\Image;

class CreateTaskJob extends Job implements SelfHandling
{
	protected $name, $type, $due_date, $recurring_date, $priority,
			  $task_members, $description, $coordinates, $notes;

	protected $household_id;

	protected $subtasks;

	/**
	 * Create a new job instance.
	 *
	 * @param $household_id
	 * @param $name
	 * @param $type
	 * @param $due_date
	 * @param $recurring_date
	 * @param $priority
	 * @param $task_members
	 * @param $description
	 * @param $coordinates
	 * @param $notes
	 * @param $subtasks
	 */
	function __construct($household_id, $name, $type, $due_date, $recurring_date,
	                     $priority, $task_members, $description, $coordinates,
	                     $notes, $subtasks)
	{
		$this->household_id = $household_id;
		$this->name = $name;
		$this->type = $type;
		$this->due_date = $due_date;
		$this->recurring_date = $recurring_date;
		$this->priority = $priority;
		$this->task_members = $task_members;
		$this->description = $description;
		$this->coordinates = $coordinates;
		$this->notes = $notes;
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
	 * add subtasks
	 * get all the numeric index of subtasks form data
	 * and treat it as user id
	 * and add members
	 *
	 * fire an event for taskcreate
	 * event will send notification to user member (it will create to notifications table)
	 *
	 * create notes if task has notes
	 */

	/**
	 * Execute the job.
	 *
	 * @param TaskRepository $taskRepository
	 * @return void
	 */
    public function handle(TaskRepository $taskRepository)
    {
        $task = Task::createTask(
			$this->household_id,
			$this->name,
			$this->type,
			$this->due_date,
			$this->recurring_date,
			$this->priority,
			null, // parent id is null
			$this->description,
			$this->coordinates
        );
		// Save image if any
	    if(Input::hasFile('image'))
	    {
			$file = Input::file('image');
		    $fileName = $this->uploadImage($file, $this->name, $this->household_id);

		    $task->image = $fileName;
	    }

	    $taskRepository->save($task, $this->task_members);

	    foreach($this->subtasks as $index => $subtask)
	    {
			$subtaskObj = Task::createTask(
					$this->household_id,
					$subtask['name'],
					$this->type,
					$this->due_date,
					$this->recurring_date,
					$this->priority,
					$task->id, // parent id
					$subtask['description']
			);

		    if ( !is_null($subtask['image']))
		    {
			    $subtask_tmp = $_FILES['subtasks']['tmp_name'];

			    $subtaskImage = Image::make(Input::file("subtasks[$index][image]"));
			    $stImageFileName = time() . '_' . $this->name . '_subtask.jpg';
				$this->uploadRaw($subtaskImage, $stImageFileName, $this->household_id);
			    $subtaskObj->image = $stImageFileName;
		    }

		    $members = Task::extractMembers($subtask);
		    // if members is 0 automatically
		    // assign it to all members on parent task
		    if(count($members) === 0) {
				$taskRepository->save($subtaskObj, $this->task_members);
		    }else{
			    $taskRepository->save($task, $members);
		    }

	    }


    }


	private function getImageDir($householdId)
	{
		return Household::findOrFail($householdId)->getTaskImagesDir();
	}

	/**
	 * Upload Task Image.
	 *
	 * @param $file
	 * @param $name
	 * @param $householdId
	 * @return string
	 */
	private function uploadImage($file, $name, $householdId)
	{
		$fileName = FileHelper::generateFileName($name, $file);
		$image = Image::make($file->getRealPath());

		/* Prevent Image from possible upsizing and Maintain Aspect Ratio */
		return $this->uploadRaw($image, $fileName, $householdId);
	}

	private function uploadRaw($image, $fileName, $householdId)
	{
		/* Create Dir if doesnt exists */
		File::exists($this->getImageDir($householdId)) or File::makeDirectory($this->getImageDir($householdId), 493, true);

		$image
			->resize(null, 640, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})
			->save($this->getImageDir($householdId) . '/' . $fileName);

		return $fileName;
	}
}
