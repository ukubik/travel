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
      $subcategories = SubCategory::whereCategoryId($category->id)->get();
      if($subcategory) {
        $articles = Article::whereSubCategoryId($subcategory->id)->wherePublished('Опубликована')->orderBy('updated_at', 'desc')->get();
      } else {
        $articles = Article::whereCategoryId($category->id)->whereSubCategoryId(null)->wherePublished('Опубликована')->orderBy('updated_at', 'desc')->get();
      }
      // dd($articles);
      if(view()->exists('category.index')) {
        return view('category.index', compact('articles', 'category', 'subcategories'));
      }
      abort(404);
    }
}
