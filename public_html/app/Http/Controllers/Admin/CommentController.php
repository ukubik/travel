<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Comment;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $comments = Comment::orderBy('id', 'desc')->paginate(5);
        if(view()->exists('admin.comments.index')) {
            return view('admin.comments.index', compact('comments'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
          'content' => 'required|string|max:1000',
          'published' => 'required|string'
        ]);

        $comment->update($request->all());
        // dd($comment);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
