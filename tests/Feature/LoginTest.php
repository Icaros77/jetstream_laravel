<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
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

        $this->postJson(route("login"), $data)
            ->assertRedirect(route("dashboard"));

        $this->assertEmpty($cart);

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fail()
    {
        $this->createUserCart();
        $data = [
            'email' => '',
            'password' => 'password'
        ];
        
        $this->assertGuest();
        $this->post(route("login"), $data)
            ->assertRedirect(route("login"))
            ->dumpSession()
            ->assertSessionHasErrors("email",null, "loginErrors");

        $this->assertGuest();
    }

    public function test_logout()
    {
        $this->withoutExceptionHandling();
        $this->createUserCart();
        $user = User::first();

        $this->actingAs($user)->postJson(route("logout"))
            ->assertRedirect(route("dashboard"));
        $this->assertGuest();
    }
}
