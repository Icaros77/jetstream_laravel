<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Service\ShoppingCartSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{
    protected $fortifyAccess;

    public function __construct()
    {
        $this->fortifyAccess = Fortify::username();
    }

    public function login(LoginRequest $req, ShoppingCartSessionService $service)
    {
        $user = Auth::user();
        if (boolval($user)) {
            return redirect()->route("dashboard");
        }

        Auth::logoutOtherDevices($req->password);
        if (Auth::attempt($req->only($this->fortifyAccess, "password"))) {
            if ($req->session()->has("session_cart.cart.cart")) {
                $service->mergeCart($req);
            }
            $req->session()->regenerate();
            return redirect()->route("dashboard");
        }
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route("dashboard");
    }
}
