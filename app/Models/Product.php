<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'slug', 'status', 'shipping_fee', 'user_id'
    ];

    protected $attributes = [
        'status' => 'active',
        'user_id' => 1
    ];

    protected $casts = [
        'created_at' => 'date: M d, Y - H:i A'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($product) {
            $product->slug = 'product-'.rand().$product->id.time();
        });
    } 

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
    }

}
