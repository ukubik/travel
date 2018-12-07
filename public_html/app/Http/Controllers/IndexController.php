<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\Article;
use App\Category;
use App\GuestMessage;
use App\Events\GuestMessage as Message;
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

    public function attachment(Article $article, $img_puth)
    {
      // dump($article);
      // dd($img_puth);
      return view('attachment', compact('article', 'img_puth'));
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

    public function contacts()
    {
      $captcha_key = config('captcha.captcha.key');

      $captcha_secret = config('captcha.captcha.secret');

      if(view()->exists('contacts')) {

        return view('contacts', compact('captcha_key', 'captcha_secret'));
      }

      abort(404);
    }

    public function sendmessage(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|max:100',
        'email' =>'required|email',
        'message' => 'required|max:1000'
      ]);

      $message = GuestMessage::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
      ]);
      event(new Message($message));
      return redirect()->back()->with('message', 'Ваше сообщение отправлено администратору ресурса.');
    }
}
