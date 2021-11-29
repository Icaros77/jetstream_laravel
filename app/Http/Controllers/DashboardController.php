<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // allow multiple address for user
        // create invoices
        // send invoice to user
        // notify vendor
        // create API for vendors
        //      - register(create) vendor
        //      - put/patch resources products/category/quantities for vendor
        //      - check current inventory
        $params = ["title" => "Dashboard"];
        if (Auth::check()) {
            $today = new DateTime("today", new DateTimeZone("Europe/Rome"));
            $month = $today->format("m");

            $user = Auth::user()->load(["orders" => function ($query) use($month) {
                $query->whereMonth("created_at", $month);
            }]);
            $orders = $user->orders;
            $params["orders"] = $orders;
        }
        return Inertia::render('Dashboard/Index', $params);
    }
}
