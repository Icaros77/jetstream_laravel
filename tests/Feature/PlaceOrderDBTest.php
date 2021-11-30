<?php

namespace Tests\Feature;

use App\Events\UserPlaceOrderEvent;
use App\Mail\OrderPlaced;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\PaymentMethodSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class PlaceOrderDBTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

        (new PaymentMethodSeeder)->run();
    }

    public function test_event_user_place_order_fires()
    {
        Event::fake();
        $this->createUserCartWithProducts();
        $user = User::with(["cart", "info"])->first();

        $info_shippment = $this->getInfoShipment($user);

        $this->actingAs($user)->get(route("cart.index"));
        $this->post(route("orders.store"), $info_shippment)
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Order has been placed!");
        Event::assertDispatched(UserPlaceOrderEvent::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_place_an_order_cart_db()
    {
        Mail::fake();
        $this->createUserCartWithProducts();

        $user = User::with(["cart", "info"])->first();
        $cart = $user->cart;
        $quantities = collect(json_decode($cart->cart))->pluck("quantity", "id");

        $total_amount_cart = $cart->total_amount_cart;
        $info_shippment = $this->getInfoShipment($user);


        $this->actingAs($user)->get(route("cart.index"));
        $this->post(route("orders.store"), $info_shippment)
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Order has been placed!");


        $this->assertDatabaseHas("orders", [
            "client_id" => $user->id,
            "cart" => $cart->cart,
            "total_amount_cart" => $total_amount_cart
        ]);

        $this->assertNull($cart->refresh()->cart);

        $products_DB = Product::select("id")->get();

        $products_DB->each(function ($product) use ($quantities) {
            $this->assertDatabaseHas("product_quantities", [
                "quantity" => 20 - $quantities[$product->id],
                "product_id" => $product->id
            ]);
        });

        Mail::assertSent(OrderPlaced::class);
    }
}
