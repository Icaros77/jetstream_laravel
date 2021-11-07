<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        // list of products
        "cart",
        
        // index
        "order_number",

        // references users
        "client_id"
    ];
}
