<?php

namespace Tests\Feature;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiGetVendorTest extends TestCase
{

    use RefreshDatabase;
    
    public function test_api_fetch_specific_vendor()
    {
        $vendor = Vendor::factory()->create();

        $this->getJson("api/vendors/$vendor->id")
            ->assertJson(fn (AssertableJson $json) =>
            $json->where("data.id", $vendor->id)
                    ->where("data.name", $vendor->name)
                    ->where("data.identifier", $vendor->identifier)
                    ->where("data.address", $vendor->address)
                    ->where("data.postal_code", $vendor->postal_code)
                    ->where("data.city", $vendor->city)
                    ->where("data.country", $vendor->country)
                    ->where("data.products", [])
        );
    }

    public function test_api_fail_to_fetch_specific_vendor()
    {
        $this->getJson("api/vendors/2")
            ->assertJson([
                "error" => "Vendor hasn't been found"
            ]);
    }
}
