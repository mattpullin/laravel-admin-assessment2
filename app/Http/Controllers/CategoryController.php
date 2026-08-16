<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /admin/categories/all
    public function index()
    {
        $categories = Category::withCount('posts')->latest()->get();

        return view('categories.index', compact('categories'));
    }

    // GET /admin/categories/create
    public function create()
    {
        return view('categories.create');
    }

    // GET /admin/categories/edit/{category}
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // POST /admin/categories/save — both create and update
    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        Category::updateOrCreate(
            ['id' => $request->input('id')],
            $validated
        );

        $message = $request->filled('id')
            ? 'Category updated successfully.'
            : 'Category created successfully.';

        return redirect()->route('categories.index')->with('success', $message);
    }

    // GET /admin/categories/delete/{category}
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
