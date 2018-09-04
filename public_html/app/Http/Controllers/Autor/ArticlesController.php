<?php

namespace App\Http\Controllers\Autor;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::whereUserId(Auth::id())->get();
        // dd($articles);
        if(view()->exists('user.article.index')) {
          return view('user.article.index', compact('articles'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      return view('user.article.create', compact('categories'));
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
      $user_id = Auth::user()->id;
      $this->validate($request, [
        'category_id' => 'required|integer',
        'art_title' => 'required|string',
        'description' => 'required|string|max:120',
        'content' => 'required|string'
      ]);

      $article = Article::create([
        'user_id' => $user_id,
        'category_id' => $request->category_id,
        'title' => $request->art_title,
        'description' => $request->description,
        'content' => $request->content
      ]);
      //
      return redirect()->route('userarticle.index')->with(['message' => 'После проверки статьи администрацией, она будет опубликована. Спасибо']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $userarticle)
    {
      //
      // dd($userarticle);
      if(view()->exists('user.article.show')) {
        return view('user.article.show', compact('userarticle'));
      }
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $userarticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $userarticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $userarticle)
    {
        //
    }
}
