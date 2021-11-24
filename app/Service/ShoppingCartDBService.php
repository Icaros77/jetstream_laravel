<?php

namespace App\Service;

use App\Http\Requests\CartRemoveItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartDBService extends ShoppingCartService
{
    /**
     * Updates the current user's cart
     * if 1 product doesn't exist in the DB
     * Throws an ProductInvalidException
     * checks id and product_number
     * @param CartUpdateReqeust $req
     * @return Void
     */

    public function updateCart(CartUpdateRequest $req): void
    {
        $user = $req->user()->load("cart:id,cart,total_amount_cart,client_id");
        $productService = new ProductService;

        $product_insert = collect($req->validated()['product_data']);

        $product_DB = $productService->checkProduct($product_insert);
        $demand = $product_insert['demand'];
        $product_number = $product_DB->product_number;

        $cart = $user->cart;
        $products_in_cart = json_decode($cart->cart) ??
            json_decode(json_encode([$product_number => (array) $product_DB]));

        if (!isset($products_in_cart->$product_number)) {
            $products_in_cart->$product_number = $product_DB;
        }
        if (isset($products_in_cart->$product_number->quantity)) {
            $products_in_cart->$product_number->quantity += $demand;
        } else {
            $products_in_cart->$product_number->quantity = $demand;
        }

        $cart->cart = json_encode($products_in_cart);
        $cart->total_amount_cart += $products_in_cart->$product_number->price * $demand;
        $cart->new_items = 1;
        $cart->save();

        DB::update(
            "UPDATE product_quantities SET quantity = (quantity - ?),
            quantity_in_process = (quantity_in_process + ?) WHERE product_id = ?",
            [$demand, $demand, $product_DB->id]
        );
    }

    public function removeItem(CartRemoveItemRequest $req): void
    {
        $product_number = $req->validated()['product_number'];
        $user  = $req->user()->load("cart");

        $cart = $user->cart;
        $cart_DB = $cart->cart;
        $cart_DB = collect($cart_DB);

        $cart_DB = $cart_DB->filter(function($product) use($product_number) {
            return $product->product_number != $product_number;
        });

        $total_amount_cart = $cart_DB->sum("total_amount");

        $cart_DB = $cart_DB->count() == 0 ? null : $cart_DB;
        $cart->cart = $cart_DB;
        $cart->total_amount_cart = $total_amount_cart;
        $cart->save();

    }
}
