<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $user = Auth::user();
            if (boolval($user)) {
                return $user;
            }
            Auth::logoutOtherDevices($req->password);
            if (Auth::attempt($req->only($this->fortifyAccess, "password"))) {
                $user = User::where($this->fortifyAccess, $req[$this->fortifyAccess])
                    ->select(
                        "id",
                        "name",
                        "email",

                    )
                    ->firstOrFail();
                $req->session()->regenerate();
                return response()->json(['user' => $user]);
            }
        } catch (Exception $e) {
            dd($e);
            return response()->json(["error" => 'An error has occurred']);
        }
    }

    public function checkSession(Request $req)
    {
        if (Auth::user()) {
            $user = User::where($this->fortifyAccess, Auth::user()->{$this->fortifyAccess})
                ->select("id", "name", "email")->first();
            return response()->json($user);
        }
        return response()->json(null);
    }
}
