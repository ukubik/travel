<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
      'link_name', 'menu_name', 'header', 'description', 'img_path', 'added_menu'
    ];
}
