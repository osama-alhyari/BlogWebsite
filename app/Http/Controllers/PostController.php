<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()) { // check if a user is logged in
            if (Auth::user()->is_admin === 1) { // check if logged in user is an admin
                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('home');
    }

    public function dashboard()
    {
        return view('admin.posts')->with(Post::all());
    }

    public function home()
    {
        $posts = Post::with('comments')->get(); // eager loading comments on posts for users to avoid n+1
        return view('user.posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->body;
        $post->save();
        return redirect()->route('getPosts');
    }

    public function create()
    {
        return view('admin.createpost');
    }
}
