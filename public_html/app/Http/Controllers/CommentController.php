<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
    * @param $id - Article ID
    */
    public function store(Request $request, $id)
    {
      $user = Auth::user();
      if(!$user) {
        abort(403, 'Только зарегистрированные пользователи могут оставлять комментарии.');
      } else {
        $article = Article::whereId($id)->first();
        $this->validate($request, [
          'content' => 'required|string|max:1000'
        ]);
        $comment = Comment::create([
          'user_id' => $user->id,
          'article_id' => $article->id,
          'content' => $request->content
        ]);
        abort(200, 'Спасибо за комментарий. В ближайшее время он будет опубликован');
      }
    }

    public function update(Requst $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
