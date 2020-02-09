<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        $parsedParams = $this->validateComment($request);
        $comment = new Comment($parsedParams);
        $comment->user_id = auth()->user()->id;
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post);
    }

    public function destroy($post_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post);
    }

    private function validateComment(Request $request)
    {
        return $request->validate([
            'content' => 'required'
        ]);
    }
}
