<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimAuthor extends Model
{
    //
    protected $fillable = [
      'user_id', 'theme', 'description', 'result'
    ];
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
