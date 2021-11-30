<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PaymentMethodSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddPaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

        (new PaymentMethodSeeder)->run();
    }

    public function test_add_payment_method_for_user()
    {
        $this->createUser();
        $user = User::first();

        $data = [
            "payment_method_id" => "3",
            "info" => "1234567890123456"
        ];

        $this->actingAs($user)
            ->post(route("payment_infos.store"), $data)
            ->assertRedirect(route("orders.create"));

        $this->assertNotNull($user->payment_methods, "No methods saved");
    }
}
