<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'role_id', 'status', 'subscription', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
      return $this->belongsTo('App\Role');
    }

    public function articles()
    {
      return $this->hasMany('App\Article');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function claim()
    {
      return $this->hasOne('App\ClaimAuthor');
    }

    public function article_likes()
    {
        return $this->hasMany('App\ArticleLike');
    }

    public function article_dislikes()
    {
        return $this->hasMany('App\ArticleDilike');
    }
}
