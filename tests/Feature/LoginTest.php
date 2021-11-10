<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    public function test_login_with_cart()
    {

        $this->createUserCart();
        $user = User::with("cart")->first();
        $data = $this->credentials();
        $cart = $user->cart->cart;

        $this->post(route("login"), $data)
            ->assertOk()
            ->assertJsonFragment($cart);

        $this->assertEmpty($cart);

        $this->assertAuthenticatedAs($user);
    }

    public function test_logout()
    {
        $this->createUserCart();
        $user = User::first();

        $this->assertGuest();
        $this->actingAs($user)->post(route("logout"));
        $this->assertGuest();
    }
}
