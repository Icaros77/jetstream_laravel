<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    protected $table = "order_infos";

    protected $fillable = [
        "client_name",
        "client_email",
        "shipment_address",
        "shipment_postal_code",
        "shipment_city",
        "shipment_country",
        "order_id"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
