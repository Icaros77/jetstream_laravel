<?php

namespace App\Service;

use App\Exceptions\ProductInvalidException;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;

/**
 * Service for SessionCart
 * not logged in users
 * @method updateCart(CartUpdateRequest $req) void
 */
class ShoppingCartSessionService extends ShoppingCartService
{

    // think if u want to implement another table for session carts
    // send a cookie with the id of the session cart of the table
    // after 3 days of inactivity, delete the cart
    // launch a scheduled timer every day and check for sessions
    // created 3 days before
    
    public function updateCart(CartUpdateRequest $req): void
    {
        $product_demanded = collect($req->validated()['product_data']);
        
        $product_service = new ProductService;
        $product_DB = $product_service->checkProduct($product_demanded);

        $product_number = $product_DB->product_number;
        $demand = $product_demanded['demand'];
        $product_DB->quantity = $product_demanded['quantity'] + $demand;

        $amount_to_add = $demand * $product_DB->price;

        $req->session()->put(
            "session_cart.cart.cart.$product_number",
            $product_DB
        );

        $req->session()->put(
            "session_cart.cart.total_amount_cart",
            $req->session()->get("session_cart.cart.total_amount_cart") + $amount_to_add
        );
    }
}
