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

    public function index()
    {
        $user = Auth::user()->load("orders.info");
        $orders = $user->orders;
        return Inertia::render("Orders/Index", ["title" => "Orders History", "orders" => $orders]);
    }

    public function create()
    {
        $params = ["title" => "Purchase!"];
        if(Auth::check()) {
            $user = Auth::user()->load("info");
            $info =  $user->info;
            $params['info'] = $info;
        }
        return Inertia::render("Orders/Create", $params);
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
