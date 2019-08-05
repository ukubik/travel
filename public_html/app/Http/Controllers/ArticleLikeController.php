<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleLike;
use App\ArticleDislike;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    public function store(Article $article, Request $request)
    {
        $this->validate($request, [
            'data' => 'required|in:-1,1',
            'user_id' => 'required|integer|min:0|not_in:0'
        ]);

        if($request->data === 1) {

            if($dislike = ArticleDislike::whereUserId($request->user_id)->whereArticleId($article->id)->first()) $dislike->delete();

            ArticleLike::create([
                'article_id' => $article->id,
                'user_id' => $request->user_id,
            ]);

        } elseif($request->data === -1) {

            if($like = ArticleLike::whereUserId($request->user_id)->whereArticleId($article->id)->first()) $like->delete();

            ArticleDislike::create([
                'article_id' => $article->id,
                'user_id' => $request->user_id,
            ]);
        }

        return $article->load(['article_likes', 'article_dislikes']);
    }
}
