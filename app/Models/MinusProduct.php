<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinusProduct extends Model
{
    protected $fillable = [
        'product_id',
        'minus_id',
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function minus()
    {
        return $this->belongsTo(Minus::class);
    }
}
