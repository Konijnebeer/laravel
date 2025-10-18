<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BlogController;
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
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');

//Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
//    Route::get('/role/{id}', [RoleController::class, 'show'])->name('role.index');
//    Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
////    adds admin in front of the url so /admin/route
//});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('/roles', RoleController::class);
});

//Route::middleware(['auth', 'admin'])->group(function () {
//    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
//});

Route::group([], function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
});

require __DIR__ . '/auth.php';
