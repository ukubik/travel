<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
      $articles = Article::all();

      $categories = Category::all();

      $comments = Comment::all();

      return view('admin.index', compact('categories', 'articles', 'comments'));
    }

    public function noPublish()
    {
      $articles = Article::wherePublished('Не опубликована')->paginate(4);

      $categories = Category::all();

      $subcategory = null;

      return view('admin.articles.index', compact('articles', 'category', 'categories', 'subcategory'));
    }
}
