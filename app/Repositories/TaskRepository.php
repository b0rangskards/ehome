<?php  namespace App\Repositories; 

use App\Task;

class TaskRepository implements RepositoryInterface {

	public function save(Task $task, $members = null)
	{
		$task->save();

		/* Insert Task Members to Pivot Table */
		if($members) $task->syncMembers($members);

		return true;
	}
} 