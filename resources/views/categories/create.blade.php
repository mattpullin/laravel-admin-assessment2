@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <h2 class="mb-3">Create New Category</h2>
    @include('categories._form')
@endsection