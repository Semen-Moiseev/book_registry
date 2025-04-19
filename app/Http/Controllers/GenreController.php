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
        $validated = $request->validate(['name' => 'required|string|max:255']);

        try {
            if (Genre::where('name', $validated['name'])->exists()) {
                throw new \Exception('Жанр с таким названием уже существует');
            }

            $genre = Genre::create($validated);
            return response()->json($genre, 201);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

        try {
            $genre->update($request->all());
            return $genre;
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/genre/{id} -> Удаление жанра с определенным id
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();
            return response()->json(null, 204);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
