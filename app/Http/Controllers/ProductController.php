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
        $query = $req->only("filter", "vendor", "category", "name");
        
        $products = $service->getProducts($query);
        $title = 'Products';

        return Inertia::render(
            "Products/Index",
            array_merge(compact("products", 'title'), $query)
        );
    }
}
