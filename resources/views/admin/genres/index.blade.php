<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список жанров</title>
</head>
<body>
    <div>
        <div>
            <h1>_____Список жанров_____</h1>
            <a href="{{ route('admin.genres.create') }}">Добавить жанр</a>
        </div>

        @if($genres->isEmpty())
            <p>Жанры не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название жанра</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                        <tr>
                            <td>{{ $genre->id }}</td>
                            <td>{{ $genre->name }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('admin.genres.edit', $genre->id) }}">Редактировать</a>
                                    <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить жанр с id {{ $genre->id }}?')"> Удалить </button>
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
