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

        "total_amount_cart",

        // references users
        "client_id"
    ];

    protected $casts = [
        "cart" => 'object',
        "cart->*" => 'object',
        "created_at" => "datetime:Y-m-d"
    ];

    public function info()
    {
        return $this->hasOne(OrderInfo::class)
            ->select(
                "order_id",
                "client_name",
                "client_email",
                "shipment_address",
                "shipment_postal_code",
                "shipment_city",
                "shipment_country"
            );
    }
}
