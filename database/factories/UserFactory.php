<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\Team;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }


    public function addCart()
    {
        return $this->afterCreating(function (User $user) {
            ShoppingList::factory()->create(["client_id" => $user->id]);
        });
    }

    public function addCartProducts()
    {
        return $this->afterCreating(function (User $user) {
            $vendors = Vendor::factory(1)->addProducts(3, 20)->create();
            $products = $vendors->first()->products;
            $products = $products->transform(function ($product) {
                $product->quantity = 15;
                $product->total_amount = $product->price * 15;
                return $product;
            });

            $total = $products->sum("total_amount");
            $products_in_cart = (object) $products->groupBy("product_number");
            $products_in_cart = $products_in_cart->transform(function ($product) {
                return (object) $product->toArray()[0];
            });

            ShoppingList::factory()->create([
                'cart' => $products_in_cart,
                "client_id" => $user->id,
                "total_amount_cart" => $total
            ]);
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
