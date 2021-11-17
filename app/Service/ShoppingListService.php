<?php

namespace App\Service;

use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;
use App\Models\ShoppingList;

class ShoppingListService
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
        $user = $req->user()->load("cart:id,cart,client_id");
        $productService = new ProductService;

        $updated_cart = collect($req->validated());
        $products_insert = collect($updated_cart->first());

        $products_DB = $productService->checksProducts($products_insert);

        $total_amount_cart = 0;
        $products_DB = $products_DB->groupBy("product_number");
        
        $data = $products_DB->map(function ($product) use ($products_insert, &$total_amount_cart) {
            $product = $product->first();
            
            $product_quantity = $products_insert[$product->product_number]['quantity'];
            $total_amount_cart += $product_quantity * $product->price;
            
            $product->total_amount = $product_quantity * $product->price;
            $product->quuantity = $product_quantity;
            
            return $product->toArray();
        });

        $cart = $user->cart;
        ShoppingList::where("id", $cart->id)
            ->update(
                [
                    "cart" => ['products' => $data],
                    "total_amount_cart" => $total_amount_cart
                ]
            );
    }
}
