<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'variant_item_id'
    ];

    public function item()
    {
        return $this->belongsTo(VariantItem::class, 'variant_item_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

}
