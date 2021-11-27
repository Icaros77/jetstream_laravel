<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MergeCartsTest extends TestCase
{
    use RefreshDatabase;

    public function test_merge_session_cart_to_existing_db_cart()
    {
        $this->createUserCart();
        $user = User::first();
        $this->actingAs($user);

        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = $product->only("id", "name", "product_number");
        $total = $demand * $product->price;
        $this->setRequestCartData($data, $demand);

        $this->post(route("cart.store"), $data)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas(
            "shopping_lists",
            ["client_id" => $user->id, "total_amount_cart" => $total]
        );

        $this->post(route("logout"));
        $this->assertGuest();

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data);


        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total);

        $credentials = [
            "email" => $user->email,
            "password" => "password"
        ];

        $response = $this->post(route("login"), $credentials);
        $response->assertSessionHas("session_cart", null);

        $this->assertDatabaseHas(
            "shopping_lists",
            ["total_amount_cart" => $total * 2, "client_id" => $user->id, "new_items" => 1]
        );

        $this->post(route("logout"));
        $this->assertGuest();

        $product_2 = $vendors->first()->products->last();
        $demand_2 = 7;
        $data_2 = $product_2->only("id", "name", "product_number");
        $total_2 = $demand_2 * $product_2->price;
        $this->setRequestCartData($data_2, $demand_2);

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data_2);

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total_2);

        $this->post(route("login"), $credentials);

        $this->assertDatabaseHas(
            "shopping_lists",
            ['client_id' => $user->id, 'total_amount_cart' => $total * 2 + $total_2]
        );
    }

    public function test_merge_session_cart_to_db_cart_after_logging()
    {
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = $product->only("id", "name", "product_number");
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data);
        $this->setRequestCartData($data, $demand, 17);
        $response = $this->post(route("cart.store"), $data);

        $total = $product->price * ($data['demand'] * 2);

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total);

        $this->createUserCart();
        $user = User::first();
        $data = [
            "email" => $user->email,
            "password" => "password"
        ];
        $response = $this->post(route("login"), $data);
        $response->assertSessionHas("session_cart", null);

        $this->assertDatabaseHas(
            "shopping_lists",
            ["total_amount_cart" => $total, "client_id" => $user->id, "new_items" => 1]
        );
    }
}
