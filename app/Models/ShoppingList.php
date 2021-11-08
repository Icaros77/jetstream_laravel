<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = [
        "cart",
        
        // references users
        "client_id"
    ];

    protected $casts = [
        'cart' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
