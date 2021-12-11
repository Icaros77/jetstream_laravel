<?php

namespace Tests\Feature;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiUpdateVendorTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_update_vendor()
    {
        $vendor = Vendor::factory()->create();

        $this->putJson("api/vendors/$vendor->id", ["name" => "new Name"])
            ->assertJson([
                "data" => [
                    "message" => "Updated with success!"
                ]
            ]);

        $this->assertDatabaseHas("vendors", ["name" => "new Name", "id" => $vendor->id]);
    }

    public function test_fail_api_update_vendor()
    {

        $this->putJson("api/vendors/2", ["name" => "new Name"])
            ->assertJson([
                "error" => "Vendor hasn't been found"
            ]);
    }
}
