<?php

namespace App\Http\Controllers;

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
}
