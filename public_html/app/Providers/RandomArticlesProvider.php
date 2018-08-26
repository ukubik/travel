<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RandomArticlesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      // View::composer(['articles.random'], function($view) {
      //   $collect = Article::wherePublished('Опубликована')->get();
      //   if(count($collect) >= 4) {
      //     $articles = $collect->random(4);
      //   } else {
      //     $articles = null;
      //   }
      //     $view->with('articles', $articles);
      //   });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
