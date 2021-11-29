<?php

namespace App\Service;

use App\Events\UserPlaceOrderEvent;
use App\Models\Order;
use App\Service\OrderService;
use App\Http\Requests\PlaceOrderRequest;
use App\Service\InfoService;
use App\Traits\PlaceOrderTrait;

class OrderServiceDB extends OrderService
{
    use PlaceOrderTrait;

    public function placeOrder(PlaceOrderRequest $req): void
    {
        $user = $req->user()->load(["cart", "info"]);

        $cart_DB = $user->cart;
        $products_in_cart = $cart_DB->cart;
        $order_number = $this->generateOrderNumber();

        $order = Order::create([
            'cart' => json_decode($products_in_cart),
            'order_number' => $order_number,
            "total_amount_cart" => $cart_DB->total_amount_cart,
            "client_id" => $user->id
        ]);

        $shipment_info = $req->validated();

        if (is_null($user->info)) {
            (new InfoService)->addShipmentInfoTo($user, $shipment_info);
        }

        // Create order info, sends email of order to client
        // modifies it that 2 events get fired
        UserPlaceOrderEvent::dispatch($order, $user, $shipment_info);

        $cart_DB->cart = null;
        $cart_DB->total_amount_cart = 0;
        $cart_DB->save();
    }
}
