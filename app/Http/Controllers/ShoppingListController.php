<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Service\ShoppingCartDBService;
use App\Service\ShoppingCartSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ShoppingListController extends Controller
{
    public function index()
    {
        return Inertia::render("Cart/Index", ['title' => 'Cart']);
    }

    public function store(CartUpdateRequest $req)
    {
        $service = Auth::check() ? new ShoppingCartDBService : new ShoppingCartSessionService;

        $service->updateCart($req);
        return redirect()->back()->with([
            "notification" => [
                "message" => "Item added to cart!"
            ]
        ]);
    }

    public function update(Request $req, $id)
    {
        $service = Auth::check() ? new ShoppingCartDBService : new ShoppingCartSessionService;
        $service->removeItem($req, $id);
        return redirect()->route("cart.index")->with([
            "notification" => ["message" => "Item removed from cart!"]
        ]);
    }
}
