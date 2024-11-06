<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->date_created = now();
        $comment->save();

        return redirect()->route('showPost', $request->post_id);
    }

    public function update(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $comment->content = $request->content;
        $post_id = $comment->post_id;
        $comment->save();

        return redirect()->route('showPost', $post_id);
    }

    public function destroy(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $post_id = $comment->post_id;
        $comment->is_deleted = 1; // soft deleting comments
        $comment->save();

        return redirect()->route('showPost', $post_id);
    }
}
