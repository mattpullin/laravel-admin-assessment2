<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // GET /api/posts
    public function index()
    {
        return Post::with('category')->latest()->get();
    }

    // GET /api/posts/{post}
    public function show(Post $post)
    {
        return $post->load('category');
    }

    // POST /api/posts
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['is_active'] = 'Yes';

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    // PUT /api/posts/{post}
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    // DELETE /api/posts/{post}
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
