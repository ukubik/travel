<?php

namespace App\Http\Controllers\Admin;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        //
        return SubCategory::whereCategoryId($category_id)->get();
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
          'category_id' => 'required|integer',
          'link_name' => 'required|string',
          'title' => 'required|string',
          'description' => 'required|string|max:500'
        ]);
        SubCategory::create($request->all());
        return SubCategory::whereCategoryId($request->category_id)->get();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        if($subCategory->articles->isNotEmpty()) {
          return abort(406, 'Удаление не возможно: подраздел имеет статьи...');
        } else {
          $subCategory->delete();
        }
    }
}
