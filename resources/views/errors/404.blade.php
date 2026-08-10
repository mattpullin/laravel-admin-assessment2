@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-1 fw-bold">404</h1>
        <h2 class="mb-3">Page Not Found</h2>
        <p class="text-muted mb-4">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
@endsection