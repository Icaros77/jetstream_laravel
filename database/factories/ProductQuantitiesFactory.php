<?php

namespace Database\Factories;

use App\Models\ProductQuantities;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductQuantitiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductQuantities::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => random_int(1,50),
            'quantity_in_process' => 0,
        ];
    }
}
