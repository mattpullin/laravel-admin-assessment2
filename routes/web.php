<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Requirement 9c: default route redirects to /admin
Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Admin group: all panel routes behind auth middleware
Route::prefix('admin')->middleware('auth')->group(function () {

    // /admin lands on the posts list
    Route::get('/', function () {
        return redirect()->route('posts.index');
    });

    // Post CRUD — per brief: /all, /create, /edit/{}, POST /save, /delete/{}
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/all', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        Route::post('/save', [PostController::class, 'save'])->name('save');
        Route::get('/delete/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    // Category CRUD — same pattern
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/all', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/save', [CategoryController::class, 'save'])->name('save');
        Route::get('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

// Fallback route with custom 404 view (Step 15)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
