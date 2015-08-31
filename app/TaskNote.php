<?php

namespace App;

use App\Transformers\TaskNoteTransformer;
use Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class TaskNote extends Model
{
	use PresentableTrait;

	/**
	 * Path to Presenter
	 *
	 * @var string
	 */
	protected $presenter = 'App\Presenters\TaskNotePresenter';

	protected $fillable = ['user_id', 'task_id', 'note'];

	protected $table = 'task_notes';

    public static function newNote($user_id, $task_id, $note)
	{
		return new static(compact('user_id', 'task_id', 'note'));
	}

	public function getTransformedData()
	{
		$transformer = new TaskNoteTransformer();

		return $transformer->transform($this);
	}

	public static function getLatestNotes($userId)
	{
		return static::where('user_id', $userId)
			->where('created_at', '>=', Carbon::now()->subDay())
			->get();
	}

	/* Relationships */

	public function owner()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function task()
	{
		return $this->belongsTo('App\Task', 'task_id');
	}

	/* Mutators & Accessors */

	public function setNoteAttribute($value)
	{
		$this->attributes['note'] = strtolower($value);
	}
}
