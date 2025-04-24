<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список авторов</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin_panel') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Список авторов_____</h1>
        <a href="{{ route('admin.authors.create') }}">Добавить автора</a>

        @if($authors->isEmpty())
            <p>Авторы не найдены</p>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">ID</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Имя</th>
                            <th style="border: 1px solid #000; padding: 10px; text-align: center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $author->id }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">{{ $author->name }}</td>
                            <td style="border: 1px solid #000; padding: 10px; text-align: center">
                                <div>
                                    <a href="{{ route('admin.authors.edit', $author->id) }}">Редактировать</a>
                                    <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить автора с id {{ $author->id }}?')"> Удалить </button>
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
