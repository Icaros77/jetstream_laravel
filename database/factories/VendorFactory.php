<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->company(),
            "identifier" => $this->faker->companySuffix(),
            "address" => $this->faker->address(),
            "postal_code" => $this->faker->postcode(),
            "city" => $this->faker->city(),
            "country" => $this->faker->country()
        ];
    }


    public function addProducts()
    {
        return $this->afterCreating(function(Vendor $vendor) {
            
            Product::factory(random_int(1, 5))->for($vendor)->create();
        });
    }
}
