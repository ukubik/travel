<?php

namespace App\Http\Controllers;

use App\Image;
use App\Article;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
      $categories = Category::all();
      // Получение последних восьми статей для вывода на главной
      $previews1 = Article::wherePublished('Опубликована')->orderBy('id', 'desc')->limit(8)->get();
      $previews2 = $previews1->splice(4);
      // dump($articles);
      // dd($preview);
      return view('index', compact('categories', 'previews1', 'previews2'));
    }
}
