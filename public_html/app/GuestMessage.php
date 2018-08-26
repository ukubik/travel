<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    protected $fillable = ['name', 'email', 'message'];
}
