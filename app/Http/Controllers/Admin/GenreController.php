<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // GET /api/genre -> Получить список жанров
    public function index() {
        $genres = Genre::orderBy('id')->paginate(10);
        return view('admin.genres.index', compact('genres'));
    }

    //Переход на страницу создания жанра
    public function create() {
        return view('admin.genres.create');
    }

    // POST /api/genre -> Создание жанра
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres'
            ]);

            Genre::create($validated);

            return redirect()->route('admin.genres.index')
                ->with('success', 'Жанр успешно добавлен');
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Переход на страницу изменения данных жанра
    public function edit(Genre $genre) {
        return view('admin.genres.edit', compact('genre'));
    }

    // PUT /api/genre/{id} -> Обновление жанра с определенным id
    public function update(Request $request, Genre $genre) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name,'.$genre->id
            ]);

            $genre->update($validated);

            return redirect()->route('admin.genres.index')->with('success', 'Жанр успешно обновлен');
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/genre/{id} -> Удаление жанра с определенным id
    public function destroy(Genre $genre) {
        try {
            $genre->delete();

            return redirect()->route('admin.genres.index')
            ->with('success', 'Жанр успешно удален');
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
