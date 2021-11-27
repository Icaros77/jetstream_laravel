<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddItemsToCartTest extends TestCase
{

    use RefreshDatabase;

    public function test_add_more_items_to_cart_db()
    {
        $this->createUserCart();
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $demand = 6;
        $data = $product->only("id", "product_number", "name");
        $this->setRequestCartData($data, $demand);

        $product_2 = $vendors->last()->products->first();
        $demand_2 = 17;
        $data_2 = $product_2->only("id", "product_number", "name");
        $this->setRequestCartData($data_2, $demand_2);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->post(route("cart.store"), $data_2)
            ->assertRedirect(route("products.index"));

        $this->setRequestCartData($data, 3, $demand + 3);

        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $total_2 = $demand_2 * $product_2->price;
        $grand_total = $total_2 + $data['quantity'] * $product->price;

        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'total_amount_cart' => $grand_total
            ]
        );

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product->quantity->id,
            "quantity_in_process" => $demand + 3
        ]);

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product_2->quantity->id,
            "quantity_in_process" => $demand_2
        ]);
    }

    
    public function test_add_more_items_to_cart_session()
    {
        $vendors = $this->setVendors();

        $product = $vendors->first()->products->first();

        $demand = 6;
        $data = $product->only("id", "product_number", "name");
        $this->setRequestCartData($data, $demand);

        $product_2 = $vendors->last()->products->first();
        $demand_2 = 17;
        $data_2 = $product_2->only("id", "product_number", "name");
        $this->setRequestCartData($data_2, $demand_2);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->post(route("cart.store"), $data_2)
            ->assertRedirect(route("products.index"));

        $this->setRequestCartData($data, 3, 6);

        $response = $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $product_info = (object) $product->only("id", "name", "product_number", "price", "image_path");
        $product_info_2 = (object) $product_2->only("id", "name", "product_number", "price", "image_path");

        $product_info->quantity = 9;
        $product_info_2->quantity = 17;

        $product_info->total_amount = 9 * $product->price;
        $product_info_2->total_amount = 17  * $product_2->price;

        $total_amount_cart = $product_info->total_amount + $product_info_2->total_amount;

        $cart_info = [
            $product_info->product_number => $product_info,
            $product_info_2->product_number => $product_info_2,
        ];

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total_amount_cart);
        $response->assertSessionHas("session_cart.cart.cart", $cart_info);
    }
}
