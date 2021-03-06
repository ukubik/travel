<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function show($id)
    {
      $article = Article::whereId($id)->wherePublished('Опубликована')->first();

      if($article && view()->exists('showart')) {
        // dd($article);
        return view('showart', compact('article'));
      }
      abort(404);
    }

    // Получение рандомных статей в раздел интересное (компонент NowReadingComponent)
    public function getRandomArt($article_id = null)
    {
      if($article_id) {
        return Article::wherePublished("Опубликована")->where('id', '!=', $article_id)->inRandomOrder()->limit(3)->get();
      } else {
        return Article::wherePublished("Опубликована")->inRandomOrder()->limit(3)->get();
      }  
    }

    // Вывод в SecondComponent
    public function rndArticle()
    {
       return Article::wherePublished('Опубликована')->inRandomOrder()->first();
    }
}
