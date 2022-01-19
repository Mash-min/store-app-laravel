<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'slug', 'product_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($productCategory) {
            $productCategory->slug = 'product-category-'.rand().$productCategory->id.time();
        });
    } 

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
