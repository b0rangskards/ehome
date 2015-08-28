<?php

namespace App\Console\Commands;

use App\Jobs\NotifyMemberTaskExpiration;
use App\Task;
use Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Log;

class TaskExpiration extends Command
{
	use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

	//convert the time created to minutes and
	//convert the due time to minutes then
	//subtract converted due time to time created
	//
	//notify when task time reached 50%
	//notify when task time reached 75%
	//notify when task ended
	/**
	 *
	 * Create a new command instance.
	 *
	 * @return \App\Console\Commands\TaskExpiration
	 */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$this->dispatch(new NotifyMemberTaskExpiration(Task::getAllActiveTasks()));
    }
}
