<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'user_id',
        'product_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($savedProduct) {
            $savedProduct->slug = 'saved-product-'.rand().$savedProduct->id.time();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
