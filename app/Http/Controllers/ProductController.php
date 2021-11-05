<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::getProducts();
        return Inertia::render("Products", compact("products"));
    }

    public function fetch_products()
    {
        $products = Product::getProducts();
        return response()->json(compact("products"));
    }
}
