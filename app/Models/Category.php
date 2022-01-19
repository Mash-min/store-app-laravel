<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'slug'
    ];

    protected $casts = [
        'created_at' => 'date: M d, Y - H:i A'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($category) {
            $category->slug = 'category-'.rand().$category->id.time();
        });
    } 
}
