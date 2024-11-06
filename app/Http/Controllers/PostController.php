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
        $posts = Post::with('comments')
        ->orderByRaw('date_created DESC')
        ->simplePaginate(2);// Paginate with 5 posts per page
    
        return view('user.posts', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',        // Title is required, max 255 characters
            'subtitle' => 'nullable|string|max:255',     // Subtitle is optional, max 255 characters if provided
            'content' => 'required|string',                 // content is required
        ]);

        // Create a new Post instance with validated data
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->subtitle = $validatedData['subtitle'] ?? null; // Assign null if subtitle is not provided
        $post->content = $validatedData['content'];
        $post->date_created = now();
        $post->save();

        return redirect()->route('getPosts');
    }


    public function create()
    {
        return view('admin.createpost');
    }



    public function show(string $id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->where('is_deleted', 0); // Filter deleted
        }])->where('id', $id)->get();

        return view('user.post', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('home');;
    }
}
