<?php  namespace App\Repositories; 

use App\TaskNote;

class TaskNoteRepository implements RepositoryInterface {

	public function save(TaskNote $note)
	{
		return $note->save();
	}

} 