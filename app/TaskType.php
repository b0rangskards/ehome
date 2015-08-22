<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'task_types';

	protected $fillable = ['name'];

	/**
	 * No timestamps field on database.
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
