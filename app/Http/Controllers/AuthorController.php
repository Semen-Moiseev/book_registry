<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserController;

class AuthorController extends Controller
{
    // GET /api/authors -> Получить список авторов
    public function index(Request $request) {
        $perPage = $request->input('per_page', 10);

        $authors = Author::withCount('books')
            ->paginate($perPage);
        return response()->json($authors);
    }

    // GET /api/authors/{id} -> Получить автора по id
    public function show($id) {
        $author = Author::with('books')->find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Автор не найден'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $author
        ]);
    }

    // POST /api/authors -> Создание автора
    public function store(Request $request) {
        try {
            $validated = $request->validate(['name' => 'required|string|max:255']);

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

    // PUT /api/authors/{id} -> Обновление данных автора с определенным id
    public function update(Request $request, Author $author) {
        try {
            if (!Auth::check()) {
                return response()->json(['message' => 'Требуется авторизация'], 401);
            }

            if (Gate::denies('update', $author)) {
                return response()->json(['message' => 'Вы можете редактировать только свой профиль'], 403);
            }

            $request->validate(['name' => 'sometimes|string|max:255']);

            $author->update($request->all());

            $response = app(UserController::class)->update($request, $author->id); //Передать сюда юсера НАДО

            return response()->json([
                'success' => true,
                'data' => $author->fresh(),
                'message' => 'Данные успешно обновлены!'
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/authors/{id} -> Удаление автора с определенным id
    public function destroy(Author $author) {
        try {
            $author->delete();
            return response()->json(null, 204);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
