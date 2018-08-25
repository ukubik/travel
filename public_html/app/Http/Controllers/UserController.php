<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
    * Получение юзера в модальное окно для идентификации
    */
    public function getUser()
    {
      return Auth::user();
    }

    /**
    * Получение роли юзера в модальное окно для идентификации
    */
    public function getRole()
    {
      return Auth::user()->role->name;
    }
}
