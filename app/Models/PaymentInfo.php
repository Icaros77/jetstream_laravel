<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "info"
    ];

    protected $casts = [
        "info" => "encrypted"
    ];
}
