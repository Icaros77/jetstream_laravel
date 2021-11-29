<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddShipmentInfosTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_infos_db()
    {
        $this->createUser();
        $user = User::first();

        $data = [
            "shipment_address" => "ads",
            "shipment_postal_code" => "122334",
            "shipment_city" => "dsa",
            "shipment_country" => "ert"
        ];

        $this->actingAs($user)
            ->post(route("infos.store"), $data)
            ->assertRedirect(route("orders.create"));

        $this->assertNotNull($user->info, "Is actually null");
    }
}
