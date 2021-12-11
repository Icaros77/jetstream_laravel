<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        "shipment_address",
        "shipment_postal_code",
        "shipment_city",
        "shipment_country",
        "default",
        "client_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
