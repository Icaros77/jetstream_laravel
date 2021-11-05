<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "image_path",
        "descrizione",
        "category"
    ];

    public static function getProducts() {
        return Product::select("id", "name", "price", "descrizione", "image_path")->get();
    }
}
