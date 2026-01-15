<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    
    protected $fillable = [
        
        'name','address','phone','email','image',
    ];

    public function getImageUrlAttribute(){
        return $this->image() ? Storage::url($this->image) : null;
    }
    protected $appends = ['image_url'];
}
