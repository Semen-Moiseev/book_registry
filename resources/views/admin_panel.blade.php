<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
</head>
<body>
    <div>
        <div>
            <h1>_____Админ-панель_____</h1>
        </div>

        <nav>
            <ul>
                <li><a href="{{ route('home') }}"> Главная </a></li>
                <li><a href="{{ route('admin.authors.index') }}"> Авторы </a></li>
                <li><a href="{{ route('home') }}"> Книги </a></li>
                <li><a href="{{ route('home') }}"> Жанры </a></li>
                <li><a href="{{ route('logout') }}">Выход</a></li>
            </ul>
        </nav>

        <p>Добро пожаловать, {{ Auth::user()->name }} ({{ Auth::user()->isAdmin() ? 'Администратор' : 'Пользователь' }})</p>
    </div>
</body>
</html>
