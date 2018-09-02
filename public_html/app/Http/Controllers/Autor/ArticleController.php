<?php

namespace App\Http\Controllers\Autor;

use App\User;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    // Форма подачи заявки на авторство
    public function newAutor(User $user)
    {
    	// dd($user);
    	if(view()->exists('user.article.claim')) {
    		return view('user.article.claim', compact('user'));
    	}
    	abort(404);
    }
}
