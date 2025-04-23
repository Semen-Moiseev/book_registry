<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список авторов</title>
</head>
<body>
    <div>
        <div>
            <h1>_____Список авторов_____</h1>
            <a href="{{ route('admin.authors.create') }}">Добавить автора</a>
        </div>

        @if($authors->isEmpty())
            <p>Авторы не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->name }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('home', $author->id) }}">Редактировать</a>
                                    <form action="{{ route('home', $author->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить этого автора?')"> Удалить </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $authors->links() }}
            </div>
        @endif
    </div>
</body>
</html>
