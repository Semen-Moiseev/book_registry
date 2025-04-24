<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Enums\BookType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    // Форматирование лог-сообщения
    private function logAction(string $action, Book $book): void {
        $message = sprintf(
            "Book %s: ID %d - '%s' (Type: %s, Author ID: %d)",
            $action,
            $book->id,
            $book->title,
            $book->type->value,
            $book->author_id
        );

        Log::channel('books')->info($message);
    }

    public function index(Request $request) {
        $query = Book::with(['author', 'genres']);

        // Фильтрация по автору
        if ($request->has('author_id') && $request->author_id) {
            $query = Book::with(['author', 'genres'])
                ->where('author_id', $request->author_id);
        }

        // Фильтрация по жанрам
        if ($request->filled('genre_ids')) {
            $genreIds = is_array($request->genre_ids) ? $request->genre_ids
                : explode(',', $request->genre_ids);

            $query->whereHas('genres', function($q) use ($genreIds) {
                $q->whereIn('id', $genreIds);
            });
        }

        $books = $query->orderBy('title')->paginate(10);
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.books.index', compact('books', 'authors', 'genres'));
    }

    public function search(Request $request) {
        $search = $request->input('search');

        $books = Book::when($search, function($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10)->appends(['search' => $search]);

        return view('admin.books.index', compact('books', 'search'));
    }

    public function create() {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.books.create', compact('authors', 'genres'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books',
            'author_id' => 'required|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        try {
            if (Book::where('title', $validated['title']) //Проверка уникальности книги с учетом автора
            ->where('author_id', $validated['author_id'])
            ->exists()) {
                throw new \Exception('Книга с таким названием у этого автора уже существует');
            }

            $book = Book::create($validated);

            if (isset($validated['genres'])) {
                $book->genres()->attach($request->genres);
            }

            $this->logAction('created', $book);

            return redirect()->route('admin.books.index')
            ->with('success', 'Книга успешно добавлена');
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Create failed: " . $e->getMessage());
            return redirect()->route('admin.books.index');
        }
    }

    public function edit(Book $book) {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book) {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255|unique:books,title,'.$book->id,
            'author_id' => 'sometimes|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        try {
            $book->update($validated);

            if (isset($validated['genres'])) {
                $book->genres()->sync($validated['genres']);
            }

            $this->logAction('updated', $book);

            return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена');
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Update failed for book {$book->id}: " . $e->getMessage());
            return redirect()->route('admin.books.index');
        }
    }

    public function destroy(Book $book) {
        try {
            $book->delete();
            $this->logAction('deleted', $book);
            return redirect()->route('admin.books.index')
            ->with('success', 'Книга успешно удалена');
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Delete failed for book {$book->id}: " . $e->getMessage());
            return redirect()->route('admin.books.index');
        }
    }
}
