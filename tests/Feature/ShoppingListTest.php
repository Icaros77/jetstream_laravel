<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();
        $this->createUserCart();
    }


    public function test_show_cart()
    {
        $user = User::first();
        $this->actingAs($user);

        $this->get(route("cart.index"))
            ->assertOk()
            ->assertInertia(function (Assert $page) {
                $page->component("Cart/Index");
            });
    }


    public function test_update_cart()
    {
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $demand = 12;
        $quantity = $demand;
        $total = $quantity * $product->price;
        $data = ['product_data' => $product->toArray()];

        $this->setRequestCartData($data, $demand, $quantity);

        $this->assertDatabaseMissing("shopping_lists", [
            'client_id' => $user->id,
            'cart' => $data['product_data'],
            "total_amount_cart" => $total
        ]);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'total_amount_cart' => $total
            ]
        );

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product->quantity->id,
            "quantity" => $product->quantity->quantity - $quantity,
            "quantity_in_process" => $demand
        ]);
    }


    public function test_add_more_items_to_cart_db()
    {
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $demand = 6;
        $data = ['product_data' => $product->toArray()];
        $this->setRequestCartData($data, $demand, $demand);

        $product_2 = $vendors->last()->products->first();
        $demand_2 = 17;
        $data_2 = ['product_data' => $product_2->toArray()];
        $this->setRequestCartData($data_2, $demand_2, $demand_2);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->post(route("cart.store"), $data_2)
            ->assertRedirect(route("products.index"));

        $this->setRequestCartData($data, 3, $demand + 3);
        $product = $product->refresh();

        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $total_2 = $demand_2 * $product_2->price;
        $grand_total = $total_2 + $data['product_data']['quantity'] * $product->price;

        $this->assertDatabaseHas(
            "shopping_lists",
            [
                'client_id' => $user->id,
                'total_amount_cart' => $grand_total
            ]
        );

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product->quantity->id,
            "quantity" => $product->refresh()->quantity->quantity,
            "quantity_in_process" => $demand + 3
        ]);

        $this->assertDatabaseHas("product_quantities", [
            "id" => $product_2->quantity->id,
            "quantity" => $product_2->refresh()->quantity->quantity,
            "quantity_in_process" => $demand_2
        ]);
    }


    public function test_add_more_items_to_cart_session()
    {
        $vendors = $this->setVendors();

        $product = $vendors->first()->products->first();

        $demand = 6;
        $data = ['product_data' => $product->toArray()];
        $this->setRequestCartData($data, $demand);

        $product_2 = $vendors->last()->products->first();
        $demand_2 = 17;
        $data_2 = ['product_data' => $product_2->toArray()];
        $this->setRequestCartData($data_2, $demand_2);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->post(route("cart.store"), $data_2)
            ->assertRedirect(route("products.index"));

        $this->setRequestCartData($data, 3, 6);

        $response = $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $product_info = $data['product_data'];
        $product_info_2 = $data_2['product_data'];
        $product_number = $product_info['product_number'];
        $product_number_2 = $product_info_2['product_number'];
        unset($product_info['demand']);
        unset($product_info_2['demand']);

        $product_info['quantity'] = 9;
        $product_info_2['quantity'] = 17;

        $total_2 = $product_info_2['quantity'] * $product_info_2['price'];
        $total = ($product_info['quantity']) * $product_info['price'];
        $total_amount_cart = $total + $total_2;

        $product_info['total_amount'] = $total;
        $product_info_2['total_amount'] = $total_2;

        $cart_info = [
            $product_number => json_decode(json_encode($product_info)),
            $product_number_2 => json_decode(json_encode($product_info_2)),
        ];

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total_amount_cart);
        $response->assertSessionHas("session_cart.cart.cart", $cart_info);
    }

    public function test_signal_new_items_in_db_cart()
    {
        $user = User::first();
        $this->actingAs($user);
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = ['product_data' => $product->toArray()];
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $this->assertDatabaseHas("shopping_lists", ["new_items" => 1, 'client_id' => $user->id]);
    }


    public function test_signal_new_items_in_session_cart()
    {
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = ['product_data' => $product->toArray()];
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data)
            ->assertRedirect(route("products.index"));

        $response->assertSessionHas("session_cart.cart.new_items", 1);
    }


    public function test_merge_session_cart_to_db_cart_after_logging()
    {
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = ['product_data' => $product->toArray()];
        $this->setRequestCartData($data, $demand);

        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data);
        $this->setRequestCartData($data, $demand, 17);
        $response = $this->post(route("cart.store"), $data);

        $total = $product->price * ($data['product_data']['demand'] * 2);

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total);

        $user = User::first();
        $data = [
            "email" => $user->email,
            "password" => "password"
        ];
        $response = $this->post(route("login"), $data);
        $response->assertSessionHas("session_cart", null);

        $this->assertDatabaseHas(
            "shopping_lists",
            ["total_amount_cart" => $total, "client_id" => $user->id, "new_items" => 1]
        );
    }

    public function test_merge_session_cart_to_existing_db_cart()
    {
        $user = User::first();
        $this->actingAs($user);

        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();
        $demand = 17;
        $data = ['product_data' => $product->toArray()];
        $total = $demand * $product->price;
        $this->setRequestCartData($data, $demand);


        $this->get(route("products.index"));
        $this->post(route("cart.store"), $data);

        $this->assertDatabaseHas(
            "shopping_lists",
            ["client_id" => $user->id, "total_amount_cart" => $total]
        );

        $this->post(route("logout"));
        $this->assertGuest();

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data);

        $total = $product->price * ($data['product_data']['demand']);

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total);

        $credentials = [
            "email" => $user->email,
            "password" => "password"
        ];

        $response = $this->post(route("login"), $credentials);
        $response->assertSessionHas("session_cart", null);

        $this->assertDatabaseHas(
            "shopping_lists",
            ["total_amount_cart" => $total * 2, "client_id" => $user->id, "new_items" => 1]
        );

        $this->post(route("logout"));
        $this->assertGuest();

        $product_2 = $vendors->first()->products->last();
        $demand_2 = 7;
        $data_2 = ['product_data' => $product_2->toArray()];
        $total_2 = $demand_2 * $product_2->price;
        $this->setRequestCartData($data_2, $demand_2);

        $this->get(route("products.index"));
        $response = $this->post(route("cart.store"), $data_2);

        $response->assertSessionHas("session_cart.cart.total_amount_cart", $total_2);

        $this->post(route("login"), $credentials);

        $this->assertDatabaseHas(
            "shopping_lists",
            ['client_id' => $user->id, 'total_amount_cart' => $total * 2 + $total_2]
        );
    }

    public function test_remove_items_from_cart_db()
    {
        $user = User::with("cart")->first();
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $cart = $user->cart;
        $cart->cart = [$product->product_number => $product->toArray()];
        $cart->save();

        $this->actingAs($user);

        $this
            ->patch(route("cart.update", ["cart" => $product->id]))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Item removed from cart!");

        $this->assertDatabaseHas("shopping_lists", ["client_id" => $user->id, "cart" => null]);

        $product_2 = $vendors->last()->products->last();

        $cart->cart = [
            $product->product_number => $product->only("id", "product_number"),
            $product_2->product_number => $product_2->only("id", "product_number"),
        ];

        $cart->save();


        $this->patch(route("cart.update", ["cart" => $product_2->id]))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Item removed from cart!");


        $cart = $cart->refresh();
        $this->assertSame(
            $cart->cart->{$product->product_number}->id,
            $product->id,
            "Ids not the same"
        );
    }

    public function test_remove_items_from_cart_session()
    {
        $this->withoutExceptionHandling();
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $product_number = $product->product_number;
        $session = [
            "session_cart.cart.cart.$product_number" => (object) array_merge(
                $product->only("id", "product_number", "price"),
                ["total_amount" => $product->price * 15]
            ),
            "session_cart.cart.total_amount_cart" => number_format($product->price * 15, 0, ".", ""),
        ];

        $this->withSession($session)
            ->patch(route("cart.update", ["cart" => $product->id]))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("session_cart.cart.cart", [])
            ->assertSessionHas("session_cart.cart.total_amount_cart", "0.00")
            ->assertSessionHas("notification.message", "Item removed from cart!");

        $product_2 = $vendors->last()->products->last();
        $product_number_2 = $product_2->product_number;

        $data_2 = array_merge(
            $product_2->only("id", "product_number", "price"),
            ["total_amount" => $product_2->price * 15]
        );

        $session["session_cart.cart.cart.$product_number_2"] = $data_2;
        $session["session_cart.cart.total_amount_cart"] = number_format(
            $product->price * 15 + $product_2->price * 15,
            0,
            ".",
            ""
        );

        $this->withSession($session)
            ->patch(route("cart.update", ["cart" => $product->id]))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("session_cart.cart.cart", [$product_number_2 => $data_2])
            ->assertSessionHas("session_cart.cart.total_amount_cart", number_format(
                $product_2->price * 15,
                0,
                ".",
                ""
            ))
            ->assertSessionHas("notification.message", "Item removed from cart!");
    }
}
