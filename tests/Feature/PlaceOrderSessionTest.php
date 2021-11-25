<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceOrderSessionTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_place_order_session()
    {
        $vendors = $this->setVendors();
        $products = $vendors->first()->products;

        $products->transform(function($product) {
            $product->quantity = random_int(15,19);
            $product->total_amount = $product->quantity * $product->price;
            return $product->withoutRelations();
        });
        $products = $products->groupBy("product_number");
        $total_amount_cart = $products->sum("total_amount");

        $session = [
            "session_cart.cart.cart" => $products,
            "session_cart.cart.total_amount_cart" => $total_amount_cart
        ];

        $this->withSession($session)
            ->post(route("orders.store"))
            ->assertRedirect(route("cart.index"));

        $this->assertDatabaseCount("orders", 1);
    }
}
