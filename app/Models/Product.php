<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model; 

class Product extends Model
{
    protected $fillable = [
        'image',
        'name',
        'email',
        'description',
        'price',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

   
    
}
