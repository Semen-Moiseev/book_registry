<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // GET /api/authors -> Получить список авторов
    public function index()
    {
        return Author::all();
    }

    // POST /api/authors -> Создание автора
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);

        try {
            if (Author::where('name', $validated['name'])->exists()) {
                throw new \Exception('Автор с таким именем уже существует');
            }

            $author = Author::create($validated);
            return response()->json($author, 201);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    // PUT /api/authors/{id} -> Обновление данных автора с определенным id
    public function update(Request $request, Author $author)
    {
        $request->validate(['name' => 'sometimes|string|max:255']);

        try {
            $author->update($request->all());
            return $author;
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    // DELETE /api/authors/{id} -> Удаление автора с определенным id
    public function destroy(Author $author)
    {
        try {
            $author->delete();
            return response()->json(null, 204);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
