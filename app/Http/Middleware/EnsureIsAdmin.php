<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    // Проверка, что пользователь является администратором
    public function handle(Request $request, Closure $next): Response {
        if (!auth()->check()) { // Пользователь не авторизован
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin()) { // Авторизован, но не админ
            return redirect()->route('home')->with('error', 'Доступ только для администраторов');
        }

        return $next($request);
    }
}
