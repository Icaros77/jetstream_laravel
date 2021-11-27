<?php

namespace App\Providers;

use App\Events\UserPlaceOrderEvent;
use App\Listeners\CreateOrderInfo;
use App\Listeners\EmailUserOrderPlaced;
use App\Listeners\UpdateProductQuantitiesTable;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserPlaceOrderEvent::class => [
            CreateOrderInfo::class,
            UpdateProductQuantitiesTable::class,
            EmailUserOrderPlaced::class,
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
