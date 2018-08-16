<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    //
    protected $fillable = [
      'article_id', 'title', 'keywords', 'description'
    ];

    public function article()
    {
      return $this->belongsTo('App\Article');
    }
}
