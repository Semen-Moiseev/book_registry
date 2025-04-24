<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование автора</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin.authors.index') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Редактирование автора_____</h1>

        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Имя автора</label>
                <input type="text" name="name" id="name" value="{{ $author->name }}" required>
            </div>

            <div>
                <a href="{{ route('admin.authors.index') }}">Отмена</a>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>
