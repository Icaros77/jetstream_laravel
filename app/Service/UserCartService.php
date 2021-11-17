<?php

namespace App\Service;

use App\Exceptions\CartInvalidException;
use App\Http\Requests\CartUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Models\Product;
use App\Models\ShoppingList;

class UserCartService
{

    /**
     * creates the user
     * @param CreateUserRequest $req
     * @return User $user
     */
    public function createUser(CreateUserRequest $req): User
    {
        $attributes = $req->except("_token", 'password', 'password_confirmation');
        $attributes['password'] = Hash::make($req->password);
        return User::create($attributes);
    }

    /**
     * creates the cart for the user
     * it could be done with an event but i want the
     * user to have the cart the moment it is sent back to the client
     * @param CreateUserRequest $req
     * @return User $user
     */
    public function createUserCart(CreateUserRequest $req): User
    {
        $user = $this->createUser($req);
        ShoppingList::create([
            'client_id' => $user->id
        ]);
        return $user;
    }

}
