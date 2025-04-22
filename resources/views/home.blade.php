<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" />
        <title>Главная страница</title>
    </head>
    <body>
        <div>
            @auth
            <div  style="float: right">
                <a href="{{ route('logout') }}" style="margin-right: 15px">Выход</a>
            </div>

            @if(Auth::user()->isAdmin())
            <div>
                <h3 class="text-lg font-medium text-blue-800">Вы администратор!</h3>
                <p>У вас есть доступ к административным функциям системы</p>
                <a href="{{ route('admin_panel') }}">Перейти в админ-панель</a>
            </div>
            @else
            <h3 class="text-lg font-medium text-blue-800">Вы обычный пользователь!</h3>
            <p>У вас нет доступа к административным функциям системы</p>
            @endif

            @else
            <div  style="float: right">
                <a href="{{ route('login') }}" style="margin-right: 15px">Вход</a>
                <a href="{{ route('register') }}" style="margin-right: 15px">Регистрация</a>
            </div>
            @endauth
        </div>
    </body>
</html>
