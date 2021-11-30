<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "info",
        "default",
        "client_id",
        "payment_method_id"
    ];

    protected $casts = [
        "info" => "encrypted"
    ];

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
