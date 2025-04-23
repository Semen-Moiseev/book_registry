<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::orderBy('name')->paginate(10);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Author $author) { //(string $id)
        return view('home', compact('author'));                             //admin.authors.edit
    }

    public function update(Request $request, Author $author) { //(string $id)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,'.$author->id
        ]);

        $author->update($validated);

        return redirect()->route('admin.authors.index')
               ->with('success', 'Автор успешно обновлен');
    }

    public function destroy(Author $author) {  //(string $id)
        $author->delete();

        return redirect()->route('admin.authors.index')
               ->with('success', 'Автор успешно удален');
    }
}
