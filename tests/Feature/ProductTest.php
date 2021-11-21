<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
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

    public function test_filter_per_category()
    {
        $this->withoutExceptionHandling();

        $this->get(route("dashboard"));


        $vendors = $this->setVendors();

        $vendor = $vendors->load([
            "products" => function($query) {
                $query->with("categories:id,name");
            }
        ])->first();

        $product = $vendor->products->first();
        $categories = $product->categories;
        $product = $product->toArray();
        $this->remove_unnecessary($product);

        $category_names = $categories->pluck("name");

        $data = [
            "filter" => $category_names->implode(" "),
            "category" => true,
            "name" => false,
            "vendor" => false,
        ];

        $this->get(route("products.index", $data))
            ->assertInertia(function (Assert $page) use ($product) {
                $page->component("Products/Index")
                    ->has("products")
                    ->where("products", $product);
            });
    }
}
