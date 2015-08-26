<?php

namespace App\Jobs;

use App\Events\TaskStatusUpdated;
use App\Jobs\Job;
use Config;
use Illuminate\Contracts\Bus\SelfHandling;
use Log;

class UpdateTaskStatusJob extends Job implements SelfHandling
{
	protected $status;
	protected $task;
	protected $from_userid;

	/**
	 * Create a new job instance.
	 *
	 * @param $from_userid
	 * @param $status
	 * @param $task
	 * @return \App\Jobs\UpdateTaskStatusJob
	 */
	function __construct($from_userid, $status, $task)
	{
		$this->from_userid = $from_userid;
		$this->status = $status;
		$this->task = $task;
	}


	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $this->task->updateStatus($this->status);

		event(new TaskStatusUpdated($this->task, $this->from_userid));
    }
}
