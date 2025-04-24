<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::withCount('books')->orderBy('id')->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function create() {
        return view('admin.authors.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors'
        ]);

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Автор успешно добавлен');
    }

    public function edit(Author $author) {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,'.$author->id
        ]);

        $author->update($validated);

        return redirect()->route('admin.authors.index')
               ->with('success', 'Автор успешно обновлен');
    }

    public function destroy(Author $author) {
        $author->delete();

        return redirect()->route('admin.authors.index')
               ->with('success', 'Автор успешно удален');
    }
}
