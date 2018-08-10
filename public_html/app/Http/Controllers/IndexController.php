<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
      $images = Image::whereImgCategoryId(11)->get();
      $north_imgs = Image::whereImgCategoryId(12)->get();
      return view('index', compact('images', 'north_imgs'));
    }
}
