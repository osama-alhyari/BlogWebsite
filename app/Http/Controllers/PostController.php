<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderByRaw('date_created DESC') // Order posts by date
        ->simplePaginate(2); // Paginate with 2 posts per page

        return view('user.posts', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate the request data, including the image
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create a new Post instance with validated data
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->subtitle = $validatedData['subtitle'] ?? null;
        $post->content = $validatedData['content'];
        $post->date_created = now();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName(); // Get a unique filename
            $image->move(public_path('posts'), $imageName); // Save to 'public/posts' directly
            $post->image = 'posts/' . $imageName; // Store relative path in the database
        }

        $post->save();

        return redirect()->route('home');
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

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('home');;
    }

    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('admin.editpost', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        // Validate the request data, including the image
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Find the post and update its data
        $post = Post::find($id);
        $post->title = $validatedData['title'];
        $post->subtitle = $validatedData['subtitle'] ?? null;
        $post->content = $validatedData['content'];

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            // Upload and save the new image
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('posts'), $imageName);
            $post->image = 'posts/' . $imageName;
        }

        $post->save();

        return redirect()->route('getPosts');
    }

    public function random()
    {
        $post = Post::with(['comments' => function ($query) {
            $query->where('is_deleted', 0);
        }])->inRandomOrder()->get();

        return view('user.post', compact('post'));
    }
}
