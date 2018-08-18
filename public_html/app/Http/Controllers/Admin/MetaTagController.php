<?php

namespace App\Http\Controllers\Admin;

use App\MetaTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dump($request->id);
        return MetaTag::whereArticleId($request->id)->first();
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
        //
        $this->validate($request, [
          'article_id' => 'required|integer',
          'title' => 'required|string',
          'keywords' => 'required|string',
          'description' => 'required|string'
        ]);

        return MetaTag::create([
          'article_id' => $request->article_id,
          'title' => $request->title,
          'keywords' => $request->keywords,
          'description' => $request->description
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetaTag  $metaTag
     * @return \Illuminate\Http\Response
     */
    public function show(MetaTag $metaTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetaTag  $metaTag
     * @return \Illuminate\Http\Response
     */
    public function edit(MetaTag $metaTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetaTag  $metaTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaTag $metaTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetaTag  $metaTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MetaTag::whereId($id)->delete();
    }
}
