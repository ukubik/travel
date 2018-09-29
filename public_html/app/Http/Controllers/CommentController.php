<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Illuminate\Http\Request;
use App\Events\NewCommentArticle;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
    * @param $id - Article ID
    */
    public function store(Request $request, $id)
    {
      // dd($request->email);
      $user_id = Auth::id();
      $article = Article::whereId($id)->first();
      $this->validate($request, [
        'name' => 'required|string|max:50',
        'email' => 'required|email',
        'content' => 'required|string|max:1000'
      ],
      [
        'content.required' => 'Нужно все же что-то написать...',
        'name.required' => 'Вы не полностью заполнили форму...',
        'email.required' => 'Вы не полностью заполнили форму...',
        'email.email' => 'Вы ввели не верный Email...',
        'content.max:1000' => 'Вы слишком много написАли. Должно быть не более 1000 символов...',
      ]);
      $comment = Comment::create([
        'user_id' => $user_id,
        'article_id' => $article->id,
        'name' => $request->name,
        'email' => $request->email,
        'content' => $request->content
      ]);
      event(new NewCommentArticle($comment));
      abort(200, 'Спасибо за комментарий. В ближайшее время он будет опубликован');
    }

    public function update(Requst $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
