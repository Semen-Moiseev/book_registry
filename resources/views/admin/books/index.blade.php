<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список книг</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin_panel') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Список книг_____</h1>

        <!-- Форма поиска -->
        <form method="GET" action="{{ route('admin.books.search') }}">
            <div>
                <input type="text" name="search"
                placeholder="Поиск по названию..." value="{{ $search ?? '' }}">
                <button type="submit">Поиск</button>
            </div>
        </form><br>

        <!-- Форма фильтрации -->
        <form method="GET" action="{{ route('admin.books.index') }}">
            <div>
                Фильтрация по автору:
                <div>
                    <label>Автор</label>
                    <select name="author_id">
                        <option value="">Все авторы</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div><br>

                Фильтрация по жанрам:
                <div>
                    <label>Жанры</label>
                    <select name="genre_ids[]" multiple>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ in_array($genre->id, (array)request('genre_ids')) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div><br>

                <div>
                    <button type="submit">Фильтровать</button>
                    <a href="{{ route('admin.books.index') }}">Сбросить</a>
                </div>
            </div>
        </form><br>

        <a href="{{ route('admin.books.create') }}">Добавить книгу</a>

        @if($books->isEmpty())
            <p>Книги не найдены</p>
        @else
            <div>
                <table style="border-collapse: collapse">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">ID</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Название книги</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Автор</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Жанр</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Тип книги</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Дата добавления</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $book->id }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $book->title }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $book->author->name }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">
                                @foreach($book->genres as $genre)
                                    <span>{{ $genre->name }}<br></span>
                                @endforeach
                            </td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $book->type }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $book->created_at->format('d.m.Y') }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">
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
