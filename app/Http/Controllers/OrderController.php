<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Models\PaymentMethod;
use App\Service\OrderServiceDB;
use App\Service\OrderServiceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index()
    {
        $params = ["title" => "Orders History"];

        if (Auth::check()) {
            $user = Auth::user()->load("orders.info");
            $orders = $user->orders;
            $params["orders"] = $orders;
        }
        return Inertia::render("Orders/Index", $params);
    }

    public function create()
    {
        $params = ["title" => "Purchase!"];
        if (Auth::check()) {
            $user = Auth::user()->load(["info"]);
            $info =  $user->info;
            $params['info'] = $info;
        }
        
        $payments_methods = PaymentMethod::select("id", "method")->get();
        $params["payment_methods"] = $payments_methods;
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
