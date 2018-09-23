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
      $user = Auth::user();
      if(!$user) {
        abort(403, 'Только зарегистрированные пользователи могут оставлять комментарии.');
      } else {
        $article = Article::whereId($id)->first();
        $this->validate($request, [
          'content' => 'required|string|max:1000'
        ],
        [
          'content.required' => 'Нужно все же что-то написать...',
          'content.max:1000' => 'Вы слишком много написАли. Должно быть не более 1000 символов...',
        ]);
        $comment = Comment::create([
          'user_id' => $user->id,
          'article_id' => $article->id,
          'content' => $request->content
        ]);
        event(new NewCommentArticle($comment));
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
