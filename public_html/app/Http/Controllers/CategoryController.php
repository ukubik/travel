<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Category $category, SubCategory $subcategory = null)
    {
      if($subcategory) {
        $articles = Article::whereSubCategoryId($subcategory->id)->wherePublished('Опубликована')->orderBy('id', 'desc')->get();
      } else {
        $articles = Article::whereCategoryId($category->id)->wherePublished('Опубликована')->orderBy('id', 'desc')->get();
      }
      // dd($articles);
      if(view()->exists('category.index')) {
        return view('category.index', compact('articles', 'category'));
      }
      abort(404);
    }
}
