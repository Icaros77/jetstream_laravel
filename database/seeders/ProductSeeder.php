<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = [
            [
                "name" => "Mele",
                "price" => "1.00",
                "image_path" => "images/mele.webp",
                "descrizione" => "Queste sono delle mele",
                "category" => "vegetables"
            ],
            [
                "name" => "Pere",
                "price" => "0.89",
                "image_path" => "images/pere.jpg",
                "descrizione" => "Queste sono delle pere",
                "category" => "vegetables"
            ],
            [
                "name" => "Banane",
                "price" => "1.20",
                "image_path" => "images/banane.jpg",
                "descrizione" => "Queste sono delle Banane",
                "category" => "vegetables"
            ],
            [
                "name" => "Nokia n95",
                "price" => "59.99",
                "image_path" => "images/banane.jpg",
                "descrizione" => "Nokia di ultima generazione!",
                "category" => "phones"
            ],
        ];

        array_walk($default, function($product) {
            Product::create($product);
        });
    }
}
