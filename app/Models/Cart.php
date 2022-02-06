<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quantity',
        'status',
        'slug',
        'user_id',
        'product_id'
    ];

    protected $attributes = [
        'status' => 'on-cart'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($cart) {
            $cart->slug = 'cart-'.rand().$cart->id.time();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function variants()
    {
        return $this->hasMany(CartVariant::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'cart_id');
    }
}
