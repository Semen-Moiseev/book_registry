<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Регистрация</title>
    </head>
    <body class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <form method="POST" action="{{ route('registerCreate') }}">
            @csrf
            <label>Имя:</label>
            <input type="text" name="name" value="">
            <label>Email:</label>
            <input type="email" name="email" value="">
            <label>Пароль:</label>
            <input type="password" name="password" value="">
            <button type="submit">Отправить</button>
        </form>
    </body>
</html>
