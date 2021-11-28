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
        // add payment method (payment table for future scalability)
        // payment info save in order info
        // allow multiple address for user
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
