<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание автора</title>
</head>
<body>
    <div>
        <h1>_____Создание автора_____</h1>

        <form action="{{ route('admin.authors.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Имя автора</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div >
                <a href="{{ route('admin.authors.index') }}">Отмена</a>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>
