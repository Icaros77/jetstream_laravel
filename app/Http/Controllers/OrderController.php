<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Service\OrderService;
use App\Service\OrderServiceDB;
use App\Service\OrderServiceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(PlaceOrderRequest $req)
    {
        $service = Auth::check() ? new OrderServiceDB : new OrderServiceSession;
        $service->placeOrder($req);
        return redirect()->route("cart.index")->with([
            "notification.message" => "Order has been placed!"
        ]);
    }
}
