<?php

namespace Tests\Feature;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiAddVendorTest extends TestCase
{

    use RefreshDatabase;

    public function send_add_vendor_request_with_fail(array $errors, Vendor $vendor, bool $keep = false)
    {
        $data = $vendor->toArray();
        if (!$keep) {
            unset($data[array_key_first($errors)]);
        }

        $this->postJson(route("vendors.store"), $data)
            ->assertJsonValidationErrors($errors);

        $this->assertDatabaseMissing("vendors", $vendor->toArray());
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_vendor_through_api()
    {
        $vendor = Vendor::factory()->make();

        $this->postJson(route("vendors.store"), $vendor->toArray())
            ->assertJsonMissingValidationErrors(
                array_keys($vendor->toArray())
            )
            ->assertJson([
                "data" => [
                    "message" => "Vendor added!"
                ]
            ]);

        $this->assertDatabaseHas("vendors", $vendor->toArray());
    }

    public function test_fail_to_add_vendor_through_api_due_missing_attribute()
    {

        $errors = [
            "name" => "Please insert a name for your company",

            "identifier" => "Please specify an identifier for your company",

            "address" => "Specifiy an address",

            "postal_code" => "Specify a postal code for the company",

            "city" => "Specify a city for the company",

            "country" => "Specify the country for the company",
        ];

        $vendor = Vendor::factory()->make();

        foreach ($errors as $key => $value) {
            $this->send_add_vendor_request_with_fail([$key => $value], $vendor);
        }
    }

    public function test_fail_to_add_vendor_through_api_due_wrong_attribute_type()
    {

        $errors = [
            "name" => "The name must be a string",

            "identifier" => "The identifier must be a string",

            "postal_code" => "The postal code must be a string",

            "address" => "The address must be a string",

            "city" => "The city must be a string",

            "country" => "The country must be a string"
        ];

        foreach ($errors as $key => $value) {
            $vendor = Vendor::factory()->make([$key => 1]);
            $this->send_add_vendor_request_with_fail([$key => $value], $vendor, true);
        }
    }

}
