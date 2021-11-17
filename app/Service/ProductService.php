<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{

    public function getProducts()
    {
        return Product::select(
            "id",
            "name",
            "product_number",
            "description",
            "price",
            "image_path"
        )->get();
    }

    /**
     * Checks if the products exists in the DB
     * and retrieves them,
     * if 1 product doesn't exist in the DB,
     * throws an ProductInvalidException
     * and doesn't update the cart,
     * checks id and product_number
     * @param Collection $products_insert
     * @return Collection $products_DB
     */
    public function checksProducts(Collection $products): Collection
    {
        $ids = $products->pluck("id")->all();
        $products_numbers = $products->pluck("product_number")->all();


        // quantity will later be included once the storage table
        // has been setted and planned
        $products_DB = Product::whereIn("product_number", $products_numbers)
            ->whereIn("id", $ids)
            ->select("price", "product_number", "name", "id")
            ->get();


        throw_if(
            $products_DB->count() != $products->count(),
            ProductInvalidException::class
        );
        return $products_DB;
    }
}
