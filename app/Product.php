<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'content',
        'image',
        'images',
        'category_id',
        'features',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
