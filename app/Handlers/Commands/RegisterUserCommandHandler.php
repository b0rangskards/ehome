<?php

namespace App\Handlers\Commands;

use App\Commands\RegisterUserCommand;

class RegisterUserCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the command.
     *
     * @param  RegisterUserCommand  $command
     * @return void
     */
    public function handle(RegisterUserCommand $command)
    {
        dd($command);
    }
}
