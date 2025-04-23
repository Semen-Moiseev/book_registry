<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список книг</title>
</head>
<body>
    <div>
        <div>
            <h1>_____Список книг_____</h1>
            <a href="{{ route('admin.books.create') }}">Добавить автора</a>
        </div>

        @if($books->isEmpty())
            <p>Авторы не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>id автора</th>
                            <th>Тип</th>
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
            </div>
        @endif
    </div>
</body>
</html>
