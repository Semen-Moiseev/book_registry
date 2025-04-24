<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование жанра</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin.genres.index') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Редактирование жанра_____</h1>

        <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Название жанра</label>
                <input type="text" name="name" id="name" value="{{ $genre->name }}" required>
            </div>

            <div>
                <a href="{{ route('admin.genres.index') }}">Отмена</a>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>
