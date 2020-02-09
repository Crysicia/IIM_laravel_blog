<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;

use Illuminate\Http\Request;

class LikePostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request, $post_id)
    {
        if (auth()->user()->likes()->where("likeable_type", "App\Post")->where('likeable_id', $comment_id)->get()->isEmpty()) {
            $post = Post::find($post_id);
            $like = new Like();
            $like->user_id = auth()->user()->id;
            $post->likes()->save($like);
        }

        return back()->withInput();
    }

    public function destroy($post_id, $like_id)
    {
        $like = Like::find($like_id);
        $like->delete();

        return back()->withInput();
    }

}
