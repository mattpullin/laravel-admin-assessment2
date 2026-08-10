@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create New Post</a>
    </div>

    @if ($posts->isEmpty())
        <div class="alert alert-info">No posts yet. Create your first one!</div>
    @else
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created At</th>
                <th style="width: 160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->content, 50) }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <span class="badge bg-{{ $post->is_active === 'Yes' ? 'success' : 'secondary' }}">
                            {{ $post->is_active }}
                        </span>
                    </td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('posts.destroy', $post) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this post?');">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection