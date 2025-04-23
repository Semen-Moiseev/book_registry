<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Enums\BookType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index() {
        $books = Book::orderBy('title')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function search(Request $request) {
        $search = $request->input('search');

        $books = Book::when($search, function($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10)->appends(['search' => $search]);

        return view('admin.books.index', compact('books', 'search'));
    }

    public function create() {
        return view('admin.books.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books',
            'author_id' => 'required|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        Book::create($validated);

        return redirect()->route('admin.books.index')
        ->with('success', 'Книга успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Book $book) {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255|unique:books,title,'.$book->id,
            'author_id' => 'sometimes|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена');
    }

    public function destroy(Book $book) {
        $book->delete();

        return redirect()->route('admin.books.index')
        ->with('success', 'Книга успешно удалена');
    }
}
