<?php

namespace Database\Factories;

use App\Models\PaymentInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "info" => implode("", $this->faker->randomElements(range(0,9), 12, true)),
        ];
    }
}
