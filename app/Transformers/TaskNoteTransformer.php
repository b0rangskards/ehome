<?php  namespace App\Transformers; 

class TaskNoteTransformer extends Transformer {

	public function transform($note)
	{
		return [
			'id' => $note->id,
			'note' => $note->present()->prettyNote,
			'taskId' => $note->task_id,
			'owner' => $note->owner->present()->prettyName,
			'ownerId' => $note->user_id,
			'timeSent' => $note->present()->informalSentDate()
		];
	}
}