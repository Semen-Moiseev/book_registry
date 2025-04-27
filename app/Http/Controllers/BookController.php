<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Enums\BookType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request) {
        $perPage = $request->input('per_page', 10);

        // Получаем книги с авторами
        $books = Book::with('author', 'genres')
            ->orderBy('title')
            ->paginate($perPage);

        return response()->json($books);
    }

    // GET /api/books/{id} -> Получить книгу по id
    public function show($id) {
        $book = Book::with('author', 'genres')->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Книга не найдена'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
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

        try {
            if (Book::where('title', $validated['title']) //Проверка уникальности книги с учетом автора
            ->where('author_id', $validated['author_id'])
            ->exists()) {
                throw new \Exception('Книга с таким названием у этого автора уже существует');
            }

            $book = Book::create($validated);

            if (isset($validated['genres'])) { //Проверка есть ли жанр
                $book->genres()->attach($validated['genres']);
            }

            $this->logAction('created', $book);

            return response()->json($book->load('genres'), 201);
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Create failed: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // PUT /api/books/{id} -> Обновление книги с определенным id
    public function update(Request $request, Book $book) {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Требуется авторизация'
                ], 401);
            }

            if (Auth::user()->cannot('delete', $book)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Вы не автор этой книги'
                ], 403);
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'type' => 'required|in:graphic,digital,print',
                'genres' => 'array',
                'genres.*' => 'exists:genres,id'
            ]);

            $book->update($validated);

            if (isset($validated['genres'])) {
                $book->genres()->sync($validated['genres']);
            }

            $this->logAction('updated', $book);

            return response()->json([
                'success' => true,
                'data' => $book->fresh() // Возвращаем обновленные данные
            ]);
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Update failed for book {$book->id}: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/books/{id} -> Удаление книги с определенным id
    public function destroy(Book $book) {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Требуется авторизация'
                ], 401);
            }

            if (Auth::user()->cannot('delete', $book)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Вы не автор этой книги'
                ], 403);
            }

            $book->delete();
            $this->logAction('deleted', $book);

            return response()->json([
                'success' => true,
                'message' => 'Книга успешно удалена!'
            ]);
        }
        catch (\Exception $e) {
            Log::channel('books')->error("Delete failed for book {$book->id}: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
