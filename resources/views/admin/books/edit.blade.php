<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование книги</title>
</head>
<body>
    <div>
        <h1>_____Редактирование книги_____</h1>

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <p>
                    <label for="title">Название книги</label>
                    <input type="text" name="title" id="title" value="{{ $book->title }}" required>
                </p>
                <p>
                    <label for="author_id">id автора</label>
                    <input type="text" name="author_id" id="author_id" value="{{ $book->author_id }}" required>
                </p>
                <p>
                    <label for="type">Тип книги (print, graphic, digital)</label>
                    <input type="text" name="type" id="type" value="{{ $book->type }}" required>
                </p>
            </div>

            <div>
                <a href="{{ route('admin.books.index') }}">Отмена</a>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>
