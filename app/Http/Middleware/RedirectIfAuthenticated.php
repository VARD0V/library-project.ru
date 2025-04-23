<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Если пользователь авторизован
        if (Auth::guard($guard)->check()) {
            // Перенаправляем на главную страницу или на профиль
            return redirect('/profile');
        }
        return $next($request);
    }
}
