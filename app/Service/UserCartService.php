<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Models\ShoppingList;

class UserCartService
{
 
    /**
     * creates the user
     * @return User
     */
    public function createUser(CreateUserRequest $req)
    {
        $attributes = $req->except("_token", 'password', 'password_confirmation');
        $attributes['password'] = Hash::make($req->password);
        return User::create($attributes);
    }

    /**
     * creates the cart for the user
     * it could be done with an event but i want the
     * user to have the cart the moment it is sent back to the client
     */
    public function createUserCart(CreateUserRequest $req)
    {
        $user = $this->createUser($req);
        ShoppingList::create([
            'cart' => [],
            'client_id' => $user->id
        ]);
        return $user;
    }
}