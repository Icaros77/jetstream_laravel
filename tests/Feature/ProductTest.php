<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ProductTest extends TestCase
{
    use RefreshDatabase;

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
}
