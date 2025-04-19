<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Enums\BookType;
use Illuminate\Http\Request;
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

    // GET /api/books -> Получить список книг
    public function index() {
        return Book::with(['author', 'genres'])->get();
    }

    // POST /api/books -> Создание книги
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book = Book::create($validated);

        if (isset($validated['genres'])) {
            $book->genres()->attach($validated['genres']);
        }

        $this->logAction('CREATED', $book);

        return response()->json($book->load('genres'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) {
        //
    }

    // PUT /api/books/{id} -> Обновление книги с определенным id
    public function update(Request $request, Book $book) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'type' => 'required|in:graphic,digital,print',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id'
        ]);
        $book->update($request->all());

        $this->logAction('UPDATED', $book);

        return $book;
    }

    // DELETE /api/books/{id} -> Удаление книги с определенным id
    public function destroy(Book $book) {
        $book->delete();
        $this->logAction('DELETED', $book);
        return response()->json(null, 204);
    }
}
