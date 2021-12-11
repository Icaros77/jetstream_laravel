<?php

namespace App\Listeners;

use App\Models\OrderInfo;
use App\Models\PaymentMethod;
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
        $user = $event->user;

        // this is bad, turn it back into an array
        // suggestions use $info->only() before sending it down
        $payment_method = PaymentMethod::find($info['payment_method'])->select("method")->first();
        $info["payment_method"] = $payment_method->method;

        OrderInfo::create(
            array_merge(
                $info,
                [
                    "client_name" => $user->name,
                    "client_email" => $user->email,

                    "order_id" => $order->id
                ]

            )
        );
    }
}
