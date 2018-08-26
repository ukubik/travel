<?php

namespace App\Http\Controllers;

use App\Image;
use App\Article;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
      $categories = Category::all();
      // Получение последних восьми статей для вывода на главной
      $previews1 = Article::wherePublished('Опубликована')->orderBy('id', 'desc')->limit(8)->get();
      $previews2 = $previews1->splice(4);
      // dump($articles);
      // dd($preview);
      return view('index', compact('categories', 'previews1', 'previews2'));
    }

    public function rules()
    {
      if(view()->exists('rules')) {

        return view('rules');
      }

      abort(404);
    }

    public function privacypolicy()
    {
      if(view()->exists('privacypolicy')) {

        return view('privacypolicy');
      }

      abort(404);
    }

    // public function contacts()
    // {
    //   if(view()->exists('contacts')) {
    //
    //     return view('contacts');
    //   }
    //
    //   abort(404);
    // }

    // public function sendmessage(Request $request)
    // {
    //   $this->validate($request, [
    //     'name' => 'required|max:100',
    //     'email' =>'required|email',
    //     'message' => 'required|max:1000'
    //   ]);
    //
    //   $guestmessage = GuestMessage::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'message' => $request->message,
    //   ]);
    //
    //   $users = User::whereRoleId(1)->get();
    //   Notification::send($users, new NewMessage($guestmessage));
    //   return redirect()->back()->with('message', 'Ваше сообщение отправлено администратору ресурса.');
    // }
}
