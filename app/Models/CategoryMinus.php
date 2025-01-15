<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMinus extends Model
{
    protected $fillable = [
        'category_id',
        'minus_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function minus()
    {
        return $this->belongsTo(Minus::class);
    }
}
