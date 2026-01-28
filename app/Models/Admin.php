<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model; 

class Admin extends Model
{

  protected $fillable = ['name', 'email', 'address', 'image'];

  public function getImageUrlAttribute()
  {
      return $this->image ? Storage::url($this->image) : null;
  }

    protected $appends = ['image_url'];

    

    
}
