<?php

namespace Tenderos\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Tenderos\Entities\Session;
use Illuminate\Support\Facades\App;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        $pusher = App::make('pusher');

        $events->listen('auth.logout', function ($user) use($pusher) {
            Session::logoutCurrent();
            $pusher->trigger('notifications', 'new-logout', $user);
        });

        $events->listen('auth.login', function ($user, $remember) use ($pusher) {
            $pusher->trigger('notifications', 'new-login', $user);
        });
    }
}
