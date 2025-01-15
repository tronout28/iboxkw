<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_iphone'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function minuses()
    {
        return $this->hasMany(Minus::class);
    }
    
}
