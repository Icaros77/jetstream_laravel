<?php

namespace App\Listeners;

use App\Events\UserPlaceOrderEvent;
use App\Mail\OrderPlaced;
use App\Models\ProductQuantities;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailUserOrderPlaced
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserPlaceOrderEvent $event)
    {
        $user = $event->user;
        $order = $event->order;


        Mail::to($user)->send(new OrderPlaced($order));
    }
}
