<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // GET /admin/posts/all — list posts with their category (newest first)
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    // GET /admin/posts/create — show create form with category dropdown
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('posts.create', compact('categories'));
    }

    // GET /admin/posts/edit/{post} — route model binding resolves $post
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('posts.edit', compact('post', 'categories'));
    }

    // POST /admin/posts/save — both create and update
    public function save(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'required|in:Yes,No',
        ], [
            'title.max' => 'The title must not exceed 50 characters.',
            'category_id.required' => 'Please select a category.',
        ]);

        Post::updateOrCreate(
            ['id' => $request->input('id')],
            $validated + ['user_id' => $request->user()->id]
        );

        $message = $request->filled('id')
            ? 'Post updated successfully.'
            : 'Post created successfully.';

        return redirect()->route('posts.index')->with('success', $message);
    }

    // GET /admin/posts/delete/{post}
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
