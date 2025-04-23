<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список книг</title>
</head>
<body>
    <div>
        <h1>_____Список книг_____</h1>

        <!-- Форма поиска -->
        <form action="{{ route('admin.books.search') }}" method="GET">
            <div>
                <input type="text" name="search"
                placeholder="Поиск по названию..." value="{{ $search ?? '' }}">
                <button type="submit">Поиск</button>
            </div>
        </form><br>

        <a href="{{ route('admin.books.create') }}">Добавить книгу</a>

        @if($books->isEmpty())
            <p>Книги не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название книги</th>
                            <th>id автора</th>
                            <th>Тип книги</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author_id }}</td>
                            <td>{{ $book->type }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('admin.books.edit', $book->id) }}">Редактировать</a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить книгу с id {{ $book->id }}?')"> Удалить </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $books->links() }}
            </div>
        @endif
    </div>
</body>
</html>
