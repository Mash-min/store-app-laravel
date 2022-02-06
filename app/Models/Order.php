<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cart_id', 'status', 'contact', 'total', 'slug'
    ];

    protected $attributes = [
        'status' => 'on-process'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($order) {
            $order->slug = 'order-'.rand().$order->id.time();
        });
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
