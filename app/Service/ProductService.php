<?php

namespace App\Service;

use App\Exceptions\QuantityException;
use App\Exceptions\SQLInjectionException;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

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
     * checks id and quantity
     * @param Collection $products_insert
     * @return stdClass $product_DB
     */
    public function checkProduct(Collection $product): stdClass
    {
        $id = $product['id'];
        $product_number = $product['product_number'];
        $quantity = $product['quantity'];
        $demand = $product['demand'];

        throw_if(
            !is_int($demand) || !is_int($id) || !is_int($quantity),
            SQLInjectionException::class
        );

        $product_DB = DB::table("products as p")
            ->join("product_quantities as q", 'p.id', 'q.product_id')
            ->where('p.id', $id)
            ->where('p.product_number', $product_number)
            ->where('q.quantity', '>', 0)
            ->select([
                'p.id',
                'p.product_number',
                'p.name',
                'p.price',
                DB::raw("(p.price * ($quantity + $demand)) as total_amount")
            ])
            ->get()
            ->first();


        throw_if(
            is_null($product_DB),
            ProductInvalidException::class
        );

        // dispatch event for notifying demand for X product

        return $product_DB;
    }
}
