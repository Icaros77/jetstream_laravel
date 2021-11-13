<?php

namespace App\Service;

use App\Models\Product;

class ProductService
{
    public function getProducts()
    {
        return Product::select(
            "id",
            "name",
            "description",
            "price",
            "image_path"
        )->get();
    }
}