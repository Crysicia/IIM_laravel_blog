<?php

namespace App\Http\Controllers;

use App\Like;
use App\Comment;

use Illuminate\Http\Request;

class LikeCommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request, $comment_id)
    {
        if (auth()->user()->likes()->where("likeable_type", "App\Comment")->where('likeable_id', $comment_id)->get()->isEmpty()) {
            $comment = Comment::find($comment_id);
            $like = new Like();
            $like->user_id = auth()->user()->id;
            $comment->likes()->save($like);
        }

        return back()->withInput();
    }

    public function destroy($comment_id, $like_id)
    {
        $like = Like::find($like_id);
        $like->delete();

        return back()->withInput();
    }

}
