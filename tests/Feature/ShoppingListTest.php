<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Vendor;
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
        $products = $vendors->load('products:id,product_number,name,price,vendor_id')->map(function ($vendor) {
            return $vendor->products;
        })->flatten();


        $total_amount = 0;
        $products = $products->groupBy('product_number')->map(function ($product) use (&$total_amount) {
            $product = $product->first();
            $quantity = random_int(1,5);
            $total = $product->price * $quantity;
            $total_amount += $total;
            return [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $quantity,
                'product_number' => $product->product_number,
                'total_amount' => $total
            ];
        });
        
        $data = [
            'products' => $products,
            'total_amount_cart' => $total_amount
        ];

        $this->assertDatabaseMissing("shopping_lists", [
            'client_id' => $user->id,
            'cart' => json_encode($data['products']),
            "total_amount_cart" => $total_amount
        ]);

        $this->postJson(route("cart.store"), $data)
            ->assertRedirect(route("dashboard"));

        $products = $data["products"];
        $total    = $data["total_amount_cart"];
        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'total_amount_cart' => $total
            ]
        );
    }
}
