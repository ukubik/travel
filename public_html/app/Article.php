<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
      'user_id', 'category_id', 'img_prew_path', 'title', 'description', 'content', 'published'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function metatag()
    {
      return $this->hasOne('App\MetaTag');
    }
}
