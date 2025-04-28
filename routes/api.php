<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;

Route::apiResource('authors', AuthorController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('books', BookController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/login', [AuthController::class, 'login']);
Route::GET('/books/{id}', [BookController::class, 'show']);
Route::GET('/authors', [AuthorController::class, 'index']);
Route::GET('/authors/{id}', [AuthorController::class, 'show']);
Route::GET('/genres', [GenreController::class, 'index']);

Route::PUT('/books/{book}', [BookController::class, 'update'])->middleware('auth:sanctum');
Route::DELETE('/books/{book}', [BookController::class, 'destroy'])->middleware('auth:sanctum');
Route::PUT('/authors/{author}', [AuthorController::class, 'update'])->middleware('auth:sanctum');
