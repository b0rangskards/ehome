<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class CheckTaskExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return \App\Console\Commands\CheckTaskExpiration
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
        Log::info('Check for task expiration');
    }
}
