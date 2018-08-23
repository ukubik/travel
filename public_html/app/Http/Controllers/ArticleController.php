<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function show($id)
    {
      $article = Article::whereId($id)->first();

      if($article && view()->exists('showart')) {
        // dd($article);
        return view('showart', compact('article'));
      }
      abort(404);
    }
}
