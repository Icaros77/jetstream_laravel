<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\MakeFuckingRequest;
use App\Models\User;
use App\Service\FortifyRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{
    protected $fortifyAccess;

    public function __construct()
    {
        $this->fortifyAccess = Fortify::username();
    }

    public function login(LoginRequest $req)
    {
        try {
            $validatations = Validator::make(
                $req->all(),
                [
                    'email' => 'required|string|email|exists:users,email',
                    'password' => 'required|string'
                ],
                [
                    'email.required' => 'Email required'
                ]
            );
            if($validatations->fails()) {
                
                return redirect()->route("dashboard");
            }
            $user = Auth::user();
            if (boolval($user)) {
                return redirect()->route("dashboard");
            }

            Auth::logoutOtherDevices($req->password);
            if (Auth::attempt($req->only($this->fortifyAccess, "password"))) {
                $req->session()->regenerate();
                return redirect()->route("dashboard");
            }
        } catch (Exception $e) {
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
