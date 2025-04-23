<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::orderBy('id')->paginate(10);
        return view('admin.genres.index', compact('genres'));
    }

    public function create() {
        return view('admin.genres.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres'
        ]);

        Genre::create($validated);

        return redirect()->route('admin.genres.index')
        ->with('success', 'Жанр успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Genre $genre) {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,'.$genre->id
        ]);

        $genre->update($validated);

        return redirect()->route('admin.genres.index')->with('success', 'Жанр успешно обновлен');
    }

    public function destroy(Genre $genre) {
        $genre->delete();

        return redirect()->route('admin.genres.index')
        ->with('success', 'Жанр успешно удален');
    }
}
