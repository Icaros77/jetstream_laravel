<?php

namespace Database\Factories;

use App\Models\Info;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Info::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipment_address' =>$this->faker->address(),
            'shipment_postal_code' => $this->faker->postcode(),
            'shipment_city' => $this->faker->city(),
            'shipment_country' => $this->faker->country(),
        ];
    }
}
