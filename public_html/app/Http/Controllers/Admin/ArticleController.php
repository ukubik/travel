<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\MetaTag;
use App\Category;
use App\SubCategory;
use App\Events\NewArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, SubCategory $subcategory = null)
    {
        //
        $categories = Category::all();
        // $subcategories = SubCategory::all();
        if($subcategory) {
          $articles = Article::whereSubCategoryId($subcategory->id)->orderBy('id', 'desc')->paginate(4);
        } else {
          $articles = Article::whereCategoryId($category->id)->whereSubCategoryId(null)->orderBy('id', 'desc')->paginate(4);
        }

        return view('admin.articles.index', compact('articles', 'category', 'categories', 'subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
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
          // 'category_id' => 'required|integer',
          'art_title' => 'required|string',
          'description' => 'required|string|max:120',
          'content' => 'required|string',
          'tag_title' => 'required|string',
          'tag_keywords' => 'required|string',
          'tag_description' => 'required|string',
        ]);

        if(strstr($request->category_id, '/')) {
          $ids = explode('/', $request->category_id);
          $article = Article::create([
            'user_id' => $user_id,
            'category_id' => $ids[0],
            'sub_category_id' => $ids[1],
            'title' => $request->art_title,
            'description' => $request->description,
            'content' => $request->content
          ]);
        } else {
          $article = Article::create([
            'user_id' => $user_id,
            'category_id' => $request->category_id,
            'title' => $request->art_title,
            'description' => $request->description,
            'content' => $request->content
          ]);
        }

        MetaTag::create([
          'article_id' => $article->id,
          'title' => $request->tag_title,
          'keywords' => $request->tag_keywords,
          'description' => $request->tag_description
        ]);
        //
        return redirect()->route('admin.article.index', $request->category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $article = Article::whereId($id)->first();
      if(view()->exists('admin.articles.show')) {
        return view('admin.articles.show', compact('article'));
      }
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
          'title' => 'required|string',
          'description' => 'required|string|max:120',
          'content' => 'required|string',
        ]);

        $article->update($request->all());

        return redirect()->route('admin.article.show', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function updateImg(Request $request, $id)
    {
        $article = Article::whereId($id)->first();

        $this->validate($request, [
          'file' => 'required|image|max:5000',
        ]);

        $path = $request->file('file')->store('images/articles', 'public');
        $this->imageResizeWidth($path);
        $article->update(['img_prew_path' => $path]);

        return $article;
    }

    /**
    * Удаление превью фото
    */
    public function delImg(Request $request)
    {
      $article = Article::whereId($request->id)->first();

      if($article) {
        Storage::delete('public/' . $article->img_prew_path);
        $article->update([
          'img_prew_path' => null
        ]);
        return $article;
      }
    }

    /**
    * Публикация
    */
    public function published(Request $request)
    {
      $article = Article::whereId($request->id)->first();

      $this->validate($request, [
        'published' => 'required|string'
      ]);
      $article->update([
        'published' => $request->published
      ]);

      if($request->published === 'Опубликована') event(new NewArticle($article));

      return $article;
    }

    /**
    * Изменение категории статьи
    */
    public function newCategory(Request $request, Article $article)
    {
      // dd($request);
      if(strstr($request->category_id, '/')) {
        $ids = explode('/', $request->category_id);
        // dd($ids[1]);
        $article->update([
          'category_id' => $ids[0],
          'sub_category_id' => $ids[1]
        ]);
      } else {
        $article->update([
          'category_id' => $request->category_id,
          'sub_category_id' => null
        ]);
      }
      return redirect()->back()->with(['message' => 'Статья перенесена в новую категорию...']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::whereId($id)->first();

        if($article && !$article->metatag && $article->comments->isEmpty()) {
          $article->delete();
        } else {
          return abort(406, 'Удаление не возможно ( сперва удалите комментарии ).');
        }
    }
}
