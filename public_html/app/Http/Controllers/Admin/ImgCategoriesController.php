<?php

namespace App\Http\Controllers\Admin;

use App\ImgCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImgCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ImgCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
          'name' => 'required|string|max:250',
          'description' => 'required|string|max:1000'
        ]);

        ImgCategory::create($request->all());
        return ImgCategory::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImgCategory  $imgCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $imgCategory = ImgCategory::whereId($id)->first();
        $this->validate($request, [
          'name' => 'required|string|max:250',
          'description' => 'required|string|max:1000'
        ]);
        $imgCategory->update($request->all());
        return response()->json(['message' => ['Изменения сохранены']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImgCategory  $imgCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = ImgCategory::whereId($id)->first();
        if($category && $category->images->isEmpty()) {
          $category->delete();
          return ImgCategory::all();
        } else {
          return abort(406, 'Удаление не возможно! В категории имеются фото...');
        }
    }
}
