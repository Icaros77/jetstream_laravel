<?php

namespace Tests;

use App\Models\ShoppingList;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * Create the user without cart
     * 
     * @return user
     */

    public function createUser()
    {
        User::factory(1)->create(["email" => 'a@hot.com']);
    }

    /**
     * create user with cart
     * @return user
     */

    public function createUserCart()
    {
        // addCart() creates a shopping cart after creating the user
        // UserFactory addCart
        User::factory(1)->addCart()->create(["email" => 'a@hot.com']);
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
}
