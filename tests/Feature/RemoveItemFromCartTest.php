<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class RemoveItemFromCartTest extends TestCase
{
    use RefreshDatabase;

    

    public function test_remove_item_from_cart_db()
    {
        $this->createUserCartWithProducts();
        $user = User::with("cart")->first();

        $cart = $user->cart;
        $total_amount_cart = $cart->total_amount_cart;

        $products = collect($cart->cart);
        $product = $products->first();
        $total_amount = $product->total_amount;
        $product_number = $product->product_number;

        $data = [
            "cart" => $product->id
        ];

        $this->actingAs($user)->get(route("cart.index"));
        $this->patch(route("cart.update", $data))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Item removed from cart!");

        $cart = $cart->refresh();
        $this->assertFalse(isset($cart->cart->$product_number));
        $this->assertSame($cart->total_amount_cart, $total_amount_cart - $total_amount, "amounts are the same");
        $this->assertDatabaseHas("product_quantities", [
            "quantity" => 20,
            "quantity_in_process" => 0,
            "product_id" => $product->id
        ]);
    }

    

    public function test_remove_items_from_cart_session()
    {
        $this->withoutExceptionHandling();
        
        $this->createUserCart();
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
    

    public function test_remove_items_from_cart_db()
    {
        
        $this->createUserCart();
        $user = User::with("cart")->first();
        $vendors = $this->setVendors();
        $product = $vendors->first()->products->first();

        $cart = $user->cart;
        $cart->cart = [$product->product_number => $product->toArray()];
        $cart->save();

        $this->actingAs($user);

        $this->patch(route("cart.update", ["cart" => $product->id]))
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Item removed from cart!");

        $this->assertNull($user->refresh()->cart->cart);

        $product_2 = $vendors->last()->products->last();

        $cart->cart = [
            $product->product_number => $product->only("id", "product_number"),
            $product_2->product_number => $product_2->only("id", "product_number"),
        ];

        $cart->save();


        $this->patch(route("cart.update", ["cart" => $product_2->id]),)
            ->assertRedirect(route("cart.index"))
            ->assertSessionHas("notification.message", "Item removed from cart!");


        $cart = $cart->refresh();
        $this->assertSame(
            $cart->cart->{$product->product_number}->id,
            $product->id,
            "Ids not the same"
        );
    }
}
