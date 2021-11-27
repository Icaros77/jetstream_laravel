<?php

namespace App\Listeners;

use App\Models\OrderInfo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrderInfo
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
    public function handle($event)
    {
        $order = $event->order;
        $info  = $event->info;
        OrderInfo::create(
            array_merge(
                $info,
                ["order_id" => $order->id],

            )
        );
    }
}
