<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
      'link_name', 'menu_name', 'header', 'description', 'img_path', 'added_menu'
    ];

    public function articles()
    {
      return $this->hasMany('App\Article');
    }

    public function subcategories()
    {
      return $this->hasMany('App\SubCategory');
    }
}
