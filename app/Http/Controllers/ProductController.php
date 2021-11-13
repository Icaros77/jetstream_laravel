<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(ProductService $service)
    {
        $products = $service->getProducts();
        return Inertia::render("Products/Index", compact("products"));
    }

    public function fetch_products()
    {
        $products = Product::getProducts();
        return response()->json(compact("products"));
    }
}
