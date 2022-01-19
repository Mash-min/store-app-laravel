<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tag', 'slug', 'product_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($productTag) {
            $productTag->slug = 'product-tag-'.rand().$productTag->id.time();
        });
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
