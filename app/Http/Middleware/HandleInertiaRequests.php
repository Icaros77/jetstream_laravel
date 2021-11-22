<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $req)
    {
        if (Auth::check()) {
            Session::forget('session_cart');
        } else if (!Session::has('session_cart')) {
            Session::put('session_cart', [
                'cart' => [
                    'cart' => [],
                    'total_amount_cart' => '0.00',
                    'new_items' => 0
                ]
            ]);
        }

        return array_merge(parent::share($req), [
            'user' => $req->user()?->load('cart:cart,client_id,total_amount_cart')->only(["id", "name", "email", "cart"]),
            'notification' => Session::get('notification'),
            'session_cart' => Session::get('session_cart'),
        ]);
    }
}
