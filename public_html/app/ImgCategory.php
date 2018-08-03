<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgCategory extends Model
{
    //
    protected $fillable = ['name', 'description'];

    public function images()
    {
      return $this->hasMany('App\Image');
    }
}
