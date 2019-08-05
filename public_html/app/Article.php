<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
      'user_id', 'category_id', 'sub_category_id', 'img_prew_path', 'title', 'description', 'content', 'published'
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

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function subcategory()
    {
      return $this->belongsTo('App\SubCategory');
    }

    public function article_likes()
    {
        return $this->hasMany('App\ArticleLike');
    }

    public function article_dislikes()
    {
        return $this->hasMany('App\ArticleDislike');
    }

    public function article_view()
    {
        return $this->hasOne('App\ArticleView');
    }
}
