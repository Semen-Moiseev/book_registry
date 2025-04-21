<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" />
        <title>Главная страница</title>
    </head>
    <body class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white antialiased">
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <a href="{{ route('logout') }}" class="">Log out</a>
            @else
            <a href="{{ route('login') }}" class="">Log in</a>
            <a href="{{ route('register') }}" class="">Register</a>
            @endauth
        </div>
    </body>
</html>
