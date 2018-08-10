<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\ImgCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $img_categories = ImgCategory::all();
        return view('admin.images', compact('img_categories'));
    }

    // Вывод картинок в компоненте ImagesComponent
    public function getImages($id)
    {
      return Image::whereImgCategoryId($id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->desc);
      $this->validate($request, [
        'img_category_id' => 'required|integer',
        'files.*' => 'required|image|max:1000',
        'description' => 'string|nullable'
      ],
      [
        'img_category_id.required' => 'Выберите файлы изображений!!!',
        'files.*.image' => 'Файл должен быть изображением'
      ]);
      if(is_array($request->file('files'))) {
      foreach($request->file('files') as $file) {
          $path = $file->store('images/site_' . $request->img_category_id, 'public');
          Image::create([
            'img_category_id' => $request->img_category_id,
            'description' => $request->description,
            'path' => $path
          ]);
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Image::whereId($id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $file = Image::whereId($id)->first();
      // dd($file->path);
      if($file) {
        Storage::delete('public/' . $file->path);
        $file->delete();
      }
    }
}
