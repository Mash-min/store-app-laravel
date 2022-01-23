<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'status', 'slug', 'variant_id'
    ];

    protected $attributes = [
        'status' => 'active',
        'image' => 'none'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($variantItem) {
            $variantItem->slug = 'variant-item-'.rand().$variantItem->id.time();
        });
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'variant_item_id');
    }
}
