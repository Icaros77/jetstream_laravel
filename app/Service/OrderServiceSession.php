<?php

namespace App\Service;

use App\Events\UserPlaceOrder;
use App\Models\Order;
use App\Service\OrderService;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\OrderInfo;
use App\Models\User;
use App\Traits\PlaceOrderTrait;

class OrderServiceSession extends OrderService
{
    use PlaceOrderTrait;
    
    public function placeOrder(PlaceOrderRequest $req):void
    {
        $infos = $req->validated();
        $cart_session = (object) $req->session()->get("session_cart.cart");
        $products_in_cart = $cart_session->cart;
        $order_number = $this->generateOrderNumber();

        $order = Order::create([
            'cart' => $products_in_cart,
            'order_number' => $order_number,
            "total_amount_cart" => $cart_session->total_amount_cart,
        ]);

        OrderInfo::create(array_merge(
            $infos,
            ["order_id" => $order->id]
        ));

        $user = new User;
        $user->name = $infos['client_name']; 
        $user->email = $infos['client_email']; 
        UserPlaceOrder::dispatch($order, $user);

        $req->session()->put("session_cart.cart.cart", null);
        $req->session()->put("session_cart.cart.total_amount_cart", "0.00");
    }
}
