<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Service\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function remove_unnecessary(&$product)
    {
        unset($product['vendor_id']);
        unset($product['created_at']);
        unset($product['updated_at']);
        unset($product['categories']);
    }

    public function test_get_products()
    {
        $this->createUser();
        $user = User::first();
        Vendor::factory(5)->addProducts()->create();
        $this->actingAs($user)->get(route("products.index"))
            ->assertOk()
            ->assertInertia(function (Assert $page) {
                $page->component("Products/Index")
                    ->has('products');
            });
    }

    public function filter_search($data)
    {
        $query = Product::query();
        $service = new ProductService;
        $filter = collect(preg_split("/\,?\++/", $data['filter']))->unique();
        
        $service->filterPer("categories", $filter, $query);

        $query->select("id", "name", "price", "description", "product_number", "image_path");

        return $query->paginate(10)->withPath(route("products.index"))->appends($data);
    }

    public function check_results($data) {
        $results = $this->filter_search($data);

        $this->get(route("products.index", $data))
            ->assertInertia(function (Assert $page) use ($results) {
                $page->component("Products/Index")
                    ->has("products")
                    ->where("products", $results);
            });
    }

    public function test_filter_search()
    {
        $this->withoutExceptionHandling();

        $this->get(route("dashboard"));


        $vendors = $this->setVendors();

        $vendor = $vendors->load([
            "products" => function ($query) {
                $query->with("categories:id,name");
            }
        ])->first();

        $product = $vendor->products->first();
        $categories = $product->categories->first();

        $data = [
            "filter" => $categories->pluck("name")->implode("+"),
            "vendor" => true,
            "category" => true,
            "name" => true,
        ];

        $this->check_results($data);

        $data['name'] = false;
        $this->check_results($data);
        
        $data['category'] = false;
        $this->check_results($data);

        $data['vendor'] = false;
        $this->check_results($data);
    }
}
