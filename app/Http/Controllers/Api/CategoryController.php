<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        return Category::latest()->get();
    }

    // GET /api/categories/{category}
    public function show(Category $category)
    {
        return $category->load('posts');
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'content' => 'required',

        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    // PUT /api/categories/{category}
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'content' => 'required',

        ]);

        $category->update($validated);

        return response()->json($category, 200);
    }

    // DELETE /api/categories/{category}
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);

        return Category::withCount('posts')->latest()->get();
    }
}
