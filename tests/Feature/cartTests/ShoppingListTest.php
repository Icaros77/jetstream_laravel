<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();
        $this->createUserCart();
    }


    public function test_show_cart()
    {
        $user = User::first();
        $this->actingAs($user);

        $this->get(route("cart.index"))
            ->assertOk()
            ->assertInertia(function (Assert $page) {
                $page->component("Cart/Index");
            });
    }


    public function test_update_cart()
    {
        $this->withoutExceptionHandling();
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $demand = 12;
        $total = $demand * $product->price;
        $data = $product->only("id", "product_number", "name");

        $this->setRequestCartData($data, $demand);

        $this->assertDatabaseMissing("shopping_lists", [
            'client_id' => $user->id,
            'cart' => $data,
            "total_amount_cart" => $total
        ]);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'total_amount_cart' => $total
            ]
        );

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product->quantity->id,
            "quantity_in_process" => $demand
        ]);
    }



    public function test_signal_new_items_in_db_cart()
    {
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = $product->only("id", "name", "product_number");
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->assertDatabaseHas("shopping_lists", ["new_items" => 1, 'client_id' => $user->id]);
    }


    public function test_signal_new_items_in_session_cart()
    {
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = $product->only("id", "name", "product_number");
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $response->assertSessionHas("session_cart.cart.new_items", 1);
    }


}
