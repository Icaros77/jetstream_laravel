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
        "client_address",
        "client_postal_code",
        "client_city",
        "client_country",
        "order_id"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
