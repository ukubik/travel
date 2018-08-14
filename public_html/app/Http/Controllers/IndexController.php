<?php

namespace App\Http\Controllers;

use App\Image;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
      $categories = Category::all();
      return view('index', compact('categories'));
    }
}
