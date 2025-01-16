<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'category',
        'price',
        'image',
        'requested',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function minuses()
    {
        return $this->belongsToMany(Minus::class, 'minus_products', 'product_id', 'minus_id');
    }

    public function minusProducts()
    {
        return $this->hasMany(MinusProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
