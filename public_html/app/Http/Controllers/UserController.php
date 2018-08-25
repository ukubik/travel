<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    // Update profile
    public function updateProfile(Request $request, User $user)
    {
      if($request->login === Auth::user()->login && $request->email === Auth::user()->email) {
        $this->validate($request, [
          'password' => 'required|string|min:6|confirmed',
        ]);
      } elseif($request->login === Auth::user()->login) {
        $this->validate($request, [
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);
      } elseif ($request->email === Auth::user()->email) {
        $this->validate($request, [
          'login' => 'required|string|cyrillic|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);
      } else {
        $this->validate($request, [
          'login' => 'required|string|cyrillic|max:255|unique:users',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);
      }
      $user->update([
        'login' => $request->login,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);
      return $user;
    }
}
