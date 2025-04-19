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
        $request->validate(['name' => 'required|string|max:255']);
        $author = Author::create($request->all());
        return response()->json($author, 201);
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
        $author->update($request->all());
        return $author;
    }

    // DELETE /api/authors/{id} -> Удаление автора с определенным id
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(null, 204);
    }
}
