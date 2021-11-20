<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Service\UserCartService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(CreateUserRequest $req, UserCartService $service)
    {
        $user = $service->createUserCart($req);
        Auth::login($user);
        return redirect()->route("dashboard");
    }
}
