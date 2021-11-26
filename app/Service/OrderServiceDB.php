<?php

namespace App\Service;

use App\Events\UserPlaceOrder;
use App\Models\Order;
use App\Service\OrderService;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\OrderInfo;
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
            'cart' => $products_in_cart,
            'order_number' => $order_number,
            "total_amount_cart" => $cart_DB->total_amount_cart,
            "client_id" => $user->id
        ]);

        $info = $req->validated();
        OrderInfo::create(
            array_merge(
                $info,
                ["order_id" => $order->id],

            )
        );

        UserPlaceOrder::dispatch($order, $user);

        $cart_DB->cart = null;
        $cart_DB->total_amount_cart = 0;
        $cart_DB->save();
    }
}
