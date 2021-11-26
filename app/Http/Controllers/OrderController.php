<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Service\OrderServiceDB;
use App\Service\OrderServiceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function create()
    {
        return Inertia::render("Orders/Index", ["title" => "Purchase!"]);
    }

    public function store(PlaceOrderRequest $req)
    {
        $service = Auth::check() ? new OrderServiceDB : new OrderServiceSession;
        $service->placeOrder($req);
        return redirect()->route("cart.index")->with([
            "notification.message" => "Order has been placed!"
        ]);
    }
}
