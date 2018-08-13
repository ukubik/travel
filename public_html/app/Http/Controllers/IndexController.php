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
      $images = Image::whereImgCategoryId(11)->get();
      $north_imgs = Image::whereImgCategoryId(12)->get();
      $categories = Category::whereId(10)->get();
      // dd($categories);
      return view('index', compact('images', 'north_imgs', 'categories'));
    }
}
