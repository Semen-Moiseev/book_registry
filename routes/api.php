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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/genres', [GenreController::class, 'index']);

Route::put('/books/{book}', [BookController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/authors/{author}', [AuthorController::class, 'update'])->middleware('auth:sanctum');
