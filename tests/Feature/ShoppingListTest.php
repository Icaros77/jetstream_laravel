<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Vendor;
use Database\Seeders\DatabaseSeeder;
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
        $cart = $user->cart->cart;

        $this->get(route("cart.index"))
            ->assertOk()
            ->assertInertia(function (Assert $page) use ($cart) {
                $page->component("ShopCart")
                    ->has("cart")
                    ->where("cart", $cart);
            });
    }

    public function test_update_cart()
    {
        $this->withoutExceptionHandling();
        $user = User::first();
        $this->actingAs($user);

        $vendors = Vendor::factory(2)->addProducts()->create();
        $products = $vendors->load('products:product_number,name,price,vendor_id')->map(function ($vendor) {
            return $vendor->products;
        })->flatten();


        $data = [
            'products' => $products->groupBy('product_number')->map(function ($product) {
                $product = $product->first();
                return [
                    'name' => $product->name,
                    'price' => $product->price,
                    'product_number' => $product->product_number,

                ];
            }),
            'total_amount' => $products->pluck("price")->sum()
        ];

        $this->assertDatabaseMissing("shopping_lists", [
            'client_id' => $user->id, 'cart' => $data
        ]);

        $this->postJson(route("cart.store"), $data)
            ->assertRedirect(route("dashboard"));

        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'cart' => json_encode($data)
            ]
        );
    }
}
