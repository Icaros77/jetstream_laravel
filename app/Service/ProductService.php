<?php

namespace App\Service;

use App\Exceptions\SQLInjectionException;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProductService
{

    /**
     * retrieves products
     * checks if filtering has been applied or not
     * @param array $query
     */
    public function getProducts(array $query)
    {
        if (count($query) == 0) {
            return $this->getAllProducts();
        } else {
            return $this->filterProducts($query);
        }
    }

    /**
     * filters per relationship
     * extract products whose relationship's name
     * column 'like' $filter array of words
     * @param String $name relationship name
     * @param Collection $filter user search criteria
     * @param QueryBuilder $query current query
     */
    public function filterPer($name, $filter, &$query)
    {
        return $query->orWhereHas($name, function (&$q) use ($filter) {

            $first_word = $filter->first();
            $q->where("name", "like", "$first_word%");
            $filter->skip(1)->each(function ($word) use (&$q) {
                $q->orWhere("name", "like", "$word%");
            });
        });
    }

    /**
     * 
     */
    public function filterProducts($query)
    {
        // $filter, $name, $vendor, $category
        extract($query);
        $filter = $filter ?? "";
        $filter = collect(preg_split("/\,?\++/", $filter))->unique();

        $query_builder = Product::query();

        $query_builder->when($filter != "" && $name == "true", function ($query) use ($filter) {
            $first_word = $filter->first();
            $query->where("name", "like", "%$first_word%");
            $filter->skip(1)->each(function ($word) use (&$query) {
                $query->orWhere("name", "like", "%$word%");
            });
            return $query;
        })

            ->when($filter != "" && $vendor == "true", function ($query) use ($filter) {
                return $this->filterPer('vendor', $filter, $query);
            })

            ->when($filter != "" && $category == "true", function ($query) use ($filter) {
                return $this->filterPer('categories', $filter, $query);
            })

            ->select("id", "name", "price", "description", "product_number", "image_path");

        return $query_builder->paginate(10)->appends($query);
    }

    /**
     * Get all products from db
     * remember to paginate the result
     * 10 per page
     */
    public function getAllProducts()
    {
        return Product::select(
            "id",
            "name",
            "product_number",
            "description",
            "price",
            "image_path"
        )->paginate(10);
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
                'p.image_path',
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
