<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
    protected $fillable = [
      'category_id', 'link_name', 'title', 'description',
    ];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function articles()
    {
      return $this->hasMany('App\Article');
    }
}
