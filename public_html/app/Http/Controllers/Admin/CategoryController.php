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
        $categories = Category::orderBy('id', 'desc')->paginate(3);
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
      // dd($request);
        $this->validate($request, [
          'file' => 'required|image|max:5000',
          // 'link_name' => 'required|cyrillic|string|unique:categories',
          'menu_name' => 'required|string|unique:categories',
          'header' => 'required|string',
          'description' => 'required|string',
        ]);
        $path = $request->file('file')->store('images/categories', 'public');
        
        $this->imageResizeWidth($path);
        Category::create([
          // 'link_name' => $request->link_name,
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
        // 'link_name' => 'required|cyrillic|string',
        'menu_name' => 'required|string',
        'header' => 'required|string',

        'description' => 'required|string',
      ]);
      $category = Category::whereId($id)->first();
      $category->update($request->all());
      return abort(200, 'Изменено');
    }

    /**
    * Обновление поля added_menu
    */
    public function updAddMenu(Request $request, $id)
    {
      $this->validate($request, [
        'added_menu' => 'required|string',
      ]);
      $category = Category::whereId($id)->first();
      $category->update([
        'added_menu' => $request->added_menu
      ]);
      return $category;
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
        // dd($category->articles);
        if($category && $category->articles->isEmpty()) {
          Storage::delete('public/' . $category->img_path);
          $category->delete();
          return Category::all();
        } else {
          return abort(406, 'Категория не найдена или имеет статьи...');
        }

    }
}
