<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Models\ShoppingList;
use App\Service\UserCartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShoppingListController extends Controller
{
    public function index(Request $req)
    {
        $user = $req->user()->load("cart");
        $cart = $user->cart->cart;
        return Inertia::render("ShopCart", compact("cart"));
    }

    public function store(CartUpdateRequest $req, UserCartService $service)
    {
        $service->updateCart($req);
        return redirect()->route('dashboard');
    }
}
