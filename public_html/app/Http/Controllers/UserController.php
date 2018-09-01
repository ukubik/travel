<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
      // dump($request->avatar_path);
      // dd(Auth::user()->avatar_path);
      if($request->avatar_path !== null) {
        $this->validate($request, [
          'avatar_path' => 'required|image|max:200'
        ]);
        if(Auth::user()->avatar_path !== 'images/avatars/default.png') {
          Storage::delete('public/' . Auth::user()->avatar_path);
        }
        
        $path = $request->avatar_path->store('images/avatars', 'public');
        $user->update([
          'avatar_path' => $path
        ]);
      }

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

    // Подписка
    public function subscrybe(Request $request, User $user)
    {
      $this->validate($request, [
        'subscription' => 'required|string'
      ]);
      $user->update($request->all());
    }
}
