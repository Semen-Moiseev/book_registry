<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // GET /api/genre -> Получить список жанров
    public function index()
    {
        return Genre::all();
    }

    // POST /api/genre -> Создание жанра
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $genre = Genre::create($request->all());
        return response()->json($genre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    // PUT /api/genre/{id} -> Обновление жанра с определенным id
    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name' => 'sometimes|string|max:255']);
        $genre->update($request->all());
        return $genre;
    }

    // DELETE /api/genre/{id} -> Удаление жанра с определенным id
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(null, 204);
    }
}
