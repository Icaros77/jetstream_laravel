<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductQuantities;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'product_number' => implode("", $this->faker->randomElements(range(0,9), 12, true)),
            'price' => random_int(100, 720),
            'description' => $this->faker->paragraph(1),
            'image_path' => $this->faker->imageUrl(),
        ];
    }

    public function addQuantity(?int $amount)
    {
        return $this->afterCreating(function (Product $product) use ($amount) {
            $amount = $amount ? $amount : random_int(20, 50);
            ProductQuantities::factory(1)->for($product)->create(['quantity' => $amount]);
        });
    }
}
