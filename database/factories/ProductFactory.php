<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    private const NAMES = [
        'Mele',
        'Pere',
        'Banane',
        'Nokia N85',
        'Iphone 22222'
    ];

    private const PRICES = [
        100,
        500,
        12000,
        75800,
        90
    ];


    private const DESCRIPTION = [
        "Description 1",
        "Description 2",
        "Description 3",
        "Description 4",
        "Description 5"
    ];

    private const IMAGE_PATH = [
        "images/banane.jpg",
        "images/mele.webp",
        "images/pere.jpg",
    ];



    private const CATEGORY = [
        "Fruits",
        "VEGETABLEs",
        "Phones",
        "Cars"
    ];

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
            'product_number' => implode("", $this->faker->randomElements([
                "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"
            ], 12, true)),
            'price' => random_int(100, 720),
            'description' => $this->faker->paragraph(1),
            'image_path' => $this->faker->imageUrl(),
            'category' => $this->faker->word()
        ];
    }
}
