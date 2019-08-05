<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $fillable = [
        'article_id', 'count'
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
