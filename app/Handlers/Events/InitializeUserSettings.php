<?php

namespace App\Handlers\Events;

use App\Events\UserHasActivated;
use App\UserSetting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InitializeUserSettings
{

    /**
     * Handle the event.
     *
     * @param  UserHasActivated  $event
     * @return void
     */
    public function handle(UserHasActivated $event)
    {
        UserSetting::initialize($event->user->id);
    }
}
