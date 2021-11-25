<?php

namespace App\Listeners;

use App\Events\UserPlaceOrder;
use App\Mail\OrderPlaced;
use App\Models\ProductQuantities;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
    public function handle(UserPlaceOrder $event)
    {
        $user = $event->user;
        $cart = $user->cart;
        $products_in_cart = $cart->cart;
        $products_in_cart = collect($products_in_cart);
        $ids = $products_in_cart->pluck("id");
        $quantities = $products_in_cart->pluck("quantity", "id");

        ProductQuantities::whereIntegerInRaw("product_id", $ids)
            ->chunk(100, function ($products_q) use ($quantities) {
                foreach ($products_q as $product) {
                    $sub_q = $quantities[$product->product_id];
                    
                    $product->quantity -= $sub_q;
                    $product->quantity_in_process -= $sub_q;
                    $product->save();
                }
            });

        
        Mail::to($user)->send(new OrderPlaced($event->order));
        
    }
}
