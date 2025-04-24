<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Вход</title>
    </head>
    <body>
        <form method="POST" action="{{ route('authentication') }}">
            @csrf
            <label>Email:</label>
            <input type="email" name="email" value="">
            <label>Пароль:</label>
            <input type="password" name="password" value="">
            <button type="submit">Отправить</button>
        </form>
    </body>
</html>
