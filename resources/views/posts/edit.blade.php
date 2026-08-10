@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2 class="mb-3">Edit Post</h2>
    @include('posts._form')
@endsection
