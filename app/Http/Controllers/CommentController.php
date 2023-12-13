<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function postComment(Request $request, String $post_id) {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $post_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect() -> back();
    }

    public function getComments(String $post_id) {
        $comments = Comment::with('user')->where('post_id', $post_id)->get();

        return $comments;
    }

    public function deleteComment(String $comment_id) {
        $comment = Comment::find($comment_id);

        if ($comment->user_id != auth() -> user() -> id) {
            return redirect() -> back();
        }

        $comment->delete();

        return redirect() -> back();
    }

    public function editComment(Request $request, String $comment_id) {
        $comment = Comment::find($comment_id);

        $request->validate([
            'content' => 'required',
        ]);

        if ($comment->user_id != auth() -> user() -> id) {
            return redirect() -> back();
        }

        Comment::where('id', $comment_id)->update([
            'content' => $request->content,
        ]);

        return back();
    }
}
