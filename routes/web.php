<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\BookController;

Route::GET('/', function() {
    return view('welcome');
});

Route::GET('home', function() {
    return view('home');
});

Route::GET('/home', [LoginController::class, 'home'])->name('home');
Route::GET('/login', [LoginController::class, 'login'])->name('login');
Route::GET('/register', [LoginController::class, 'register'])->name('register');

Route::POST('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::POST('/register', [LoginController::class, 'registerCreate'])->name('registerCreate');

Route::GET('/logout', [LoginController::class, 'logout'])->name('logout');

//
//АДМИН-ПАНЕЛЬ
//

Route::GET('/admin_panel', [LoginController::class, 'admin_panel'])->name('admin_panel');

Route::GET('admin.authors.index', [AuthorController::class, 'index'])->name('admin.authors.index');
Route::GET('admin.authors.create', [AuthorController::class, 'create'])->name('admin.authors.create');
Route::POST('admin.authors.store', [AuthorController::class, 'store'])->name('admin.authors.store');
Route::GET('admin.authors.edit/{author}', [AuthorController::class, 'edit'])->name('admin.authors.edit');
Route::PUT('admin.authors.update/{author}', [AuthorController::class, 'update'])->name('admin.authors.update');
Route::DELETE('admin.authors.destroy/{author}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');

Route::GET('admin.genres.index', [GenreController::class, 'index'])->name('admin.genres.index');
Route::GET('admin.genres.create', [GenreController::class, 'create'])->name('admin.genres.create');
Route::POST('admin.genres.store', [GenreController::class, 'store'])->name('admin.genres.store');
Route::GET('admin.genres.edit/{genre}', [GenreController::class, 'edit'])->name('admin.genres.edit');
Route::PUT('admin.genres.update/{genre}', [GenreController::class, 'update'])->name('admin.genres.update');
Route::DELETE('admin.genres.destroy/{genre}', [GenreController::class, 'destroy'])->name('admin.genres.destroy');

Route::GET('admin.books.index', [BookController::class, 'index'])->name('admin.books.index');
Route::GET('admin.books.create', [BookController::class, 'create'])->name('admin.books.create');
Route::POST('admin.books.store', [BookController::class, 'store'])->name('admin.books.store');
Route::GET('admin.books.edit/{book}', [BookController::class, 'edit'])->name('admin.books.edit');
Route::PUT('admin.books.update/{book}', [BookController::class, 'update'])->name('admin.books.update');
Route::DELETE('admin.books.destroy/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');

Route::GET('admin.books.search', [BookController::class, 'search'])->name('admin.books.search');
