<?php

namespace App\Providers;

use App\Events\EmployeeLoggedIn;
use App\Events\EmployeeLoggedOut;
use App\Events\LowStockEvent;
use App\Listeners\LogEmployeeSession;
use App\Listeners\SendLowStockNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        EmployeeLoggedIn::class => [
            LogEmployeeSession::class, 'handleEmployeeLoggedIn',
        ],
        EmployeeLoggedOut::class => [
            LogEmployeeSession::class, 'handleEmployeeLoggedOut',
        ],
        LowStockEvent::class => [
            SendLowStockNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
