@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Create New Category</a>
    </div>

    @if ($categories->isEmpty())
        <div class="alert alert-info">No categories yet. Create your first one!</div>
    @else
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Content</th>
                <th>Posts</th>
                <th>Created At</th>
                <th style="width: 160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->content, 60) }}</td>
                    <td><span class="badge bg-info">{{ $category->posts_count }}</span></td>
                    <td>{{ $category->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('categories.destroy', $category) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this category? Its posts will also be deleted.');">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection