<?php

namespace App\Service;

// use Illuminate\Http\Request;
use App\Http\Requests\PlaceOrderRequest;

abstract class OrderService
{

    /**
     * places an order and 
     * empties the user cart
     * @param PlaceOrderRequest $req
     * 
     */
    abstract public function placeOrder(PlaceOrderRequest $req) :void;

}
