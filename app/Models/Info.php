<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        "address",
        "postal_code",
        "city",
        "country",
        "client_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
