<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/home/search', [HomeController::class, 'search'])->name('home.search');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::resource('/blogs', BlogController::class)->only('index');
    Route::resource('/blogs.posts', PostController::class)->only('index');
    Route::resource('/tags', TagController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('/blogs', BlogController::class)
        ->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->withoutMiddlewareFor('show', 'auth');
    Route::post('/blogs/{blog}/toggle-follow', [BlogController::class, 'toggleFollow'])->name('blogs.toggleFollow');
    Route::post('/blogs/{blog}/toggle-publish', [BlogController::class, 'togglePublish'])->name('blogs.togglePublish');
    Route::resource('/blogs.posts', PostController::class)
        ->withoutMiddlewareFor('show', 'auth')
        ->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');
    Route::post('/blogs/{blog}/posts/{post}/toggle-publish', [PostController::class, 'publish'])->name('posts.togglePublish');
});

require __DIR__ . '/auth.php';
