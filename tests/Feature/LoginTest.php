<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Create the user and the shopping cart
     * 
     * @return model
     */

    public function createUser()
    {
        User::factory(1)->create();
        $user = User::find(1);
        ShoppingList::create([
            'client_id' => $user->id,
            'cart' => []
        ]);
    }
    /**
     * Fetch credentials
     *
     * @return array
     */
    public function credentials()
    {
        $user = User::find(1);
        
        return [
            "email" => $user->email,
            "password" => "password"
        ];
    }

    public function test_login_with_cart()
    {

        $this->createUser();
        $user = User::with("cart")->find(1);
        $data = $this->credentials();
        $cart = $user->cart->cart;

        $this->post(route("login"), $data)
            ->assertOk()
            ->assertJsonFragment($cart);

        $this->assertEmpty($cart);

        $this->assertAuthenticatedAs($user);
    }
}
