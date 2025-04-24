<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список жанров</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin_panel') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Список жанров_____</h1>
        <a href="{{ route('admin.genres.create') }}">Добавить жанр</a>

        @if($genres->isEmpty())
            <p>Жанры не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">ID</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Название жанра</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                        <tr>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $genre->id }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $genre->name }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">
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
