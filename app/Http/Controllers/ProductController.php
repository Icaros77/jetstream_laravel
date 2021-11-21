<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $req, ProductService $service)
    {
        $products = $service->getProducts($req);
        $title = 'Products';
        // dd($products->items());
        return Inertia::render("Products/Index", compact("products", 'title'));
    }

    public function fetch_products()
    {
        $products = Product::getProducts();
        return response()->json(compact("products"));
    }
}
