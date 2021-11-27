<?php

namespace App\Listeners;

use App\Models\ProductQuantities;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductQuantitiesTable
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
        $products_in_cart = $order->cart;
        $products_in_cart = collect($products_in_cart);
        $ids = $products_in_cart->pluck("id");
        $quantities = $products_in_cart->pluck("quantity", "id");
        
        ProductQuantities::whereIntegerInRaw("product_id", $ids)
            ->chunk(100, function ($products_q) use ($quantities) {
                foreach ($products_q as $product) {
                    $sub_q = $quantities[$product->product_id];

                    $product->quantity -= $sub_q;
                    $product->quantity = $product->quantity < 0 ? 0 : $product->quantity;
                    $product->quantity_in_process -= $sub_q;
                    $product->quantity_in_process = $product->quantity_in_process < 0 ? 0 : $product->quantity_in_process;
                    $product->save();
                }
            });
    }
}
