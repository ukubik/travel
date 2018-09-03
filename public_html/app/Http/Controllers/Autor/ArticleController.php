<?php

namespace App\Http\Controllers\Autor;

use App\User;
use App\Article;
use App\ClaimAuthor;
use Illuminate\Http\Request;
use App\Events\ClaimNewAuthor;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    // Форма подачи заявки на авторство
    public function newAuthor(User $user)
    {
    	// dd($user);
    	if(view()->exists('user.article.claim')) {
    		return view('user.article.claim', compact('user'));
    	}
    	abort(404);
    }

    public function newClaim(Request $request)
    {
      $user = User::whereId($request->user_id)->first();
      if($user->claim) return redirect()->route('index')->with(['errors' => ['Вы уже подавали заявку']]);
      $this->validate($request, [
        'user_id' => 'required|integer',
        'theme' => 'required|string|max:150',
        'description' => 'required|string|max:1000'
      ]);

      $claim = ClaimAuthor::create($request->all());
      event(new ClaimNewAuthor($claim));
      return redirect()->route('index')->with(['message' => 'Ваша заявка принята. Вы будете уведомлены о результате рассмотрения. Спасибо.']);
    }
}
