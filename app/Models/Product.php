<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "product_number",
        "price",
        "image_path",
        "description",
        "category",
        "vendor_id"
    ];

    public function vendor()
    {
       return  $this->belongsTo(Vendor::class);
    }

    public function quantity()
    {
        return $this->hasOne(ProductQuantities::class);
    }
}
