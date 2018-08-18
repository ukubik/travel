<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
     public function boot()
     {
       $this->getCategories();
     }

     /**
      * Register the application services.
      *
      * @return void
      */
     public function register()
     {
         //
     }

     public function getCategories()
     {
       View::composer('admin.layouts.nav', function($view)
       {
         $view->with('categories', Category::all());
       });
     }
}
