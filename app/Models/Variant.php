<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status', 'slug', 'product_id'
    ];

    protected $attributes = [
        'status' => 'active'
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($variant) {
            $variant->slug = 'variant-'.rand().$variant->id.time();
        });
    } 

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(VariantItem::class, 'variant_id');
    }

}
