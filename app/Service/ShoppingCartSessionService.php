<?php

namespace App\Service;

use App\Http\Requests\CartRemoveItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $req->session()->put("session_cart.cart.new_items", 1);
    }

    /**
     * merges the session cart to user db cart
     * @param LoginRequest $req
     * @return Void
     */
    public function mergeCart(LoginRequest $req): void
    {
        $user = $req->user()->load("cart");
        
        $cart_session = collect($req->session()->get("session_cart.cart.cart"));
        $cart_DB = $user->cart;
        
        $new_cart = $this->merge_carts($cart_session, $cart_DB->cart);

        $new_cart = collect($new_cart);

        $cart_DB->cart = json_encode($new_cart);
        $cart_DB->total_amount_cart = $new_cart->sum("total_amount");
        $cart_DB->new_items = 1;
        $cart_DB->save();
    }

    /**
     * merges the Session and DB cart together
     * if product is present, sums up the quantities
     * $cart_DB is $user->cart->cart
     * which is a JSON
     * @param Collection $fresh_cart
     * @param String $cart_DB
     */
    public function merge_carts($fresh_cart, $cart_DB)
    {
        $products_cart_DB = json_decode($cart_DB);
        $products_cart_session = $fresh_cart->map(function($product) {
            $product = json_encode($product);
            return json_decode($product);
        });
        
        if($products_cart_DB) {
            $products_cart_session->each(function($product_s, $product_number) use(&$products_cart_DB) {
                if(isset($products_cart_DB->$product_number)) {
                    $product_DB = $products_cart_DB->$product_number;
                    $product_DB->quantity += $product_s->quantity;
                    $product_DB->total_amount = $product_DB->quantity * $product_DB->price;
                    $products_cart_DB->$product_number = $product_DB;
                }else {
                    $products_cart_DB->$product_number = $product_s;
                }
            });
        } else {
            $products_cart_DB = $products_cart_session;
        }
        return $products_cart_DB;
    }

    public function removeItem(Request $req, $id): void
    {
        $cart = collect($req->session()->get("session_cart.cart.cart"));
        
        $product = $cart->first(function($product) use($id) {
            return $product->id == $id;
        });

        if(is_null($product)) {
            return;
        }
        $product_number = $product->product_number;
        
        $req->session()->forget("session_cart.cart.cart.$product_number");

        $total_amount = $product->total_amount;
        $total_amount_cart = collect($cart)->sum("total_amount") - $total_amount;
        $total_amount_cart = $total_amount_cart ? $total_amount_cart : "0.00";
        
        $req->session()->put("session_cart.cart.total_amount_cart", $total_amount_cart);
    }
}
