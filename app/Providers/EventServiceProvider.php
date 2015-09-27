<?php

namespace App\Providers;

use App\Events\SampleEvent;
use App\Events\TaskHasCreated;
use App\Events\TaskStatusUpdated;
use App\Events\UserHasActivated;
use App\Events\UserHasRegistered;
use App\Handlers\Events\GenerateTaskUpdatedNotification;
use App\Handlers\Events\InitializeUserSettings;
use App\Handlers\Events\RegisterFreeTrial;
use App\Handlers\Events\NotifyTaskMembers;
use App\Handlers\Events\SendConfirmationEmail;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],

	    UserHasRegistered::class => [
		  SendConfirmationEmail::class,
	    ],

	    UserHasActivated::class => [
		    RegisterFreeTrial::class,
		    InitializeUserSettings::class,
	    ],

	    TaskHasCreated::class => [
		  NotifyTaskMembers::class,
	    ],

	    TaskStatusUpdated::class => [
	    ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
