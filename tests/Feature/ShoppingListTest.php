<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
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

        $this->get(route("cart"))
            ->assertOk()
            ->assertInertia(function (Assert $page) use($cart) {
                $page->component("ShopCart")
                    ->has("cart")
                    ->where("cart", $cart);
            });
    }
}
