<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minus extends Model
{
    protected $fillable = [
        'minus_product',
        'minus_price',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'minus_products', 'minus_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categoryMinuses()
    {
        return $this->hasMany(CategoryMinus::class);
    }

    public function categoryMinus()
{
    return $this->hasMany(CategoryMinus::class, 'minus_id');
}

    
}
