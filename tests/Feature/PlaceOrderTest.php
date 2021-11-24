<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceOrderTest extends TestCase
{
    use RefreshDatabase;

    public function prepareProduct($product)
    {
        $product_number = $product->product_number;
        $product_in_cart = (object) [$product->product_number => $product->only("id", "product_number", "price")];
        
        $product_in_cart->$product_number->total_amount = $product->price * 15;
        $product_in_cart->$product_number->quantity = 15;
        return $product_in_cart;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_place_an_order()
    {
        $this->createUserCartWithProducts();
        $user = User::with("cart")->first();
        
        $cart = $user->cart;

        $products_in_cart = collect($cart->cart)->toArray();
        
        $this->get(route("cart.index"));
        $this->post(route("order.create"), $products_in_cart)
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Order has been placed!");

    }
}
