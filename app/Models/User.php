<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'profile_photo_url',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function cart()
    {
        return $this->hasOne(ShoppingList::class, 'client_id');
    }

    public function info()
    {
        return $this->hasMany(Info::class, 'client_id')
            ->select("id", "client_id", "address", "postal_code", "city", "country", "default");
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "client_id")
            ->with("info")
            ->select("client_id", "id", "cart", "order_number", "total_amount_cart", "created_at")
            ->orderBy("created_at", "DESC");
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentInfo::class, "client_id")
            ->with("payment_method")
            ->select("client_id", "payment_method_id",  "info", "default");
    }
}
