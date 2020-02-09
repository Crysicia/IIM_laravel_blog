<?php

namespace App\Http\Controllers;

// -- Notes
// Always require the model(s)
use App\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // -- Notes
    // Requests are intercepted by middlewares
    // Laravel makes a heavy use of middlewares
    // Middleware's names are defined by $routeMiddleware in app/Http/Kernel.php
    // Middlewares must be called from the Controller's constructor
    // (Since a new controller is instanciated each time a request is made)
    // 
    // We use the 'auth' middleware to force the user authentication
    // on certain routes (Here all except index and show)

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::all();

        // -- Notes
        // 'posts/index' and 'posts.index' are the same
        // They both refer to the views/posts/index.blade.php file
        // 
        // Locales can be passed to the view through a hash
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $parsedParams = $this->validatePost($request);
        $post = new Post($parsedParams);
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $parsedParams = $this->validatePost($request);
        $post->fill($parsedParams);
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    private function validatePost(Request $request)
    {
        return $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required'
        ]);
    }
}
