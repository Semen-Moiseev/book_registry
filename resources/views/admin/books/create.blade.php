<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание книги</title>
</head>
<body>
    <div>
        <div  style="float: right">
            <a href="{{ route('admin.books.index') }}" style="margin-right: 15px">Назад</a>
        </div>

        <h1>_____Создание книги_____</h1>

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf
            <div>
                <p>
                    <label for="title">Название книги</label>
                    <input type="text" name="title" id="title" required>
                </p>
                <p>
                    <label for="author_id">Автор</label>
                    <select name="author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="genres[]">Жанры</label>
                    <select name="genres[]" multiple required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="type">Тип книги</label>
                    <select name="type" required>
                        <option value="graphic">Графический</option>
                        <option value="digital">Цифровой</option>
                        <option value="print">Печатный</option>
                    </select>
                </p>
            </div>
            <div >
                <a href="{{ route('admin.books.index') }}">Отмена</a>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>
