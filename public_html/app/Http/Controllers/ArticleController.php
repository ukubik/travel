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
    public function getRandomArt()
    {
        $collect = Article::wherePublished('Опубликована')->get();
        if(count($collect) >= 3) {
          return $articles = $collect->random(3);
        } else {
          return $articles = null;
        }
    }

    // Вывод в SecondComponent
    public function rndArticle()
    {
       return Article::inRandomOrder()->first();
    }
}
