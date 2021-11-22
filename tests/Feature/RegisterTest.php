<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * send post request to register user and create cart
     * and send the user resource back with associated cart
     *  @return Void
     */

    public function test_register_user_create_cart()
    {
        $this->assertGuest();

        $user = User::factory(1)->make()->first();
        $data = $user->attributesToArray();

        $this->assertDatabaseMissing("users", $data);
        $this->assertDatabaseCount('shopping_lists', 0);

        $data["password"] = "password";
        $data["password_confirmation"] = "password";
        unset($user);

        $this->postJson(route("register"), $data)
            ->assertRedirect(route("dashboard"));

        $data = User::first()->attributesToArray();
        $this->assertDatabaseHas('users', $data);
        $this->assertDatabaseCount('shopping_lists', 1);
        $this->assertDatabaseHas('shopping_lists', ['client_id' => $data['id']]);
    }
}
