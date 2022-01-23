<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'firstname',
        'lastname',
        'contact',
        'address',
        'slug',
        'role',
        'email',
        'password',
    ];

    protected $attributes = [
        'role' => 'user'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($user) {
            $user->slug = 'user-'.rand().time();
        });
    }

    public function savedProducts()
    {
        return $this->hasMany(SavedProduct::class, 'user_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function productAlreadySaved($productId)
    {
        return $this->savedProducts()->where(['product_id' => $productId])->exists();
    }

    public function productAlreadyInCart($productId)
    {
        return $this->carts()->where(['product_id' => $productId])->exists();
    }
}
