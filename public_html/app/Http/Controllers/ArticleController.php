<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //
    public function show($id)
    {
      $article = Article::whereId($id)->wherePublished('Опубликована')->with(['article_likes', 'article_dislikes'])->first();
      // dump($article);
      if($article && view()->exists('showart')) {

        if(!Auth::user() || Auth::user()->role_id !== 1 && Auth::user()->id !== $article->user_id) {
            $article->article_view ?  $article->article_view->update(['count' => $article->article_view->count + 1]) : ArticleView::create(['article_id' => $article->id, 'count' => 1]);
        }

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
