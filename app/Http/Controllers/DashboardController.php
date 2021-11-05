<?php

namespace App\Http\Controllers;

use App\Models\Product;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $today = new DateTime("now", new DateTimeZone("Europe/Rome"));
        $interval = new DateInterval("P1W");
        $products = Product::whereDate("created_at", ">=", $today->sub($interval))
            ->select("id", "name", "price", "image_path", "category")->get();

        $products = $products->groupBy("category");

        return Inertia::render(
            'Dashboard',
            [
                "products" => $products
            ]
        );
    }
}
