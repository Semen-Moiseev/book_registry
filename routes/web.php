<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AuthorController;

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
Route::PUT('admin/authors/update/{author}', [AuthorController::class, 'update'])->name('admin.authors.update');
Route::DELETE('admin.authors.destroy/{author}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
