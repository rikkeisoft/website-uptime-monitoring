<?php

namespace App\Providers;

use App\Events\SendMailGroup;
use App\Listeners\SendMailGroupListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendMailGroup::class => [
            SendMailGroupListener::class,
        ],
         'App\Events\UserCreated' => [
            'App\Listeners\UserCreatedListener',
         ],
         'App\Events\SendAlertToGroup' => [
            'App\Listeners\SendAlertToGroupListener',
         ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
