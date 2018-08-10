<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'file' => 'required|image|max:1200',
          'link_name' => 'required|cyrillic|string',
          'menu_name' => 'required|string',
          'header' => 'required|string',
          'description' => 'required|string',
        ]);
        $path = $request->file('file')->store('images/categories', 'public');
        Category::create([
          'link_name' => $request->link_name,
          'menu_name' => $request->menu_name,
          'header' => $request->header,
          'description' => $request->description,
          'img_path' => $path,
        ]);
        return Category::all();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'link_name' => 'required|cyrillic|string',
        'menu_name' => 'required|string',
        'header' => 'required|string',
        'description' => 'required|string',
      ]);
      $category = Category::whereId($id)->first();
      $category->update($request->all());
      return Category::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::whereId($id)->first();
        if($category) {
          Storage::delete('public/' . $category->img_path);
          $category->delete();
          return Category::all();
        } else {
          return abort(406, 'No search');
        }

    }
}
