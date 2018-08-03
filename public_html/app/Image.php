<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = ['img_category_id', 'path', 'description'];

    public function img_category()
    {
      return $this->belongsTo('App\ImgCategory');
    }
}
