<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm() {
        return view('auth.register');
    }
    // Регистрация
    public function register(RegisterRequest $request)
    {
        // Находим роль пользователя
        $role_user = Role::where('code', 'user')->first();

        // Проверяем, загружено ли изображение
        $path = null;
        if ($request->hasFile('avatar_url')) {
            $path = $request->file('avatar_url')->store('avatars', 'public');
        }
        // Создаем нового пользователя
        $user = User::create([
            ...$request->validated(),
            'avatar_url' => $path, // Сохраняем путь к аватару
            'role_id' => $role_user->id,
        ]);
        // Аутентификация
        Auth::login($user);
        // Создание токена
        $user->createToken('default')->plainTextToken;
        return redirect()->route('home');
    }
    // Показать форму входа
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Аутентификация
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            // Не нужно обновлять сессию
            $user = Auth::user();
            $token = $user->createToken('default')->plainTextToken;
            return redirect()->route('home')->with('token', $token);
        } else {
            return response()->json(['error' => 'Неправильный логин или пароль'], 401);
        }
    }
    public function show()
    {
        return view('auth.profile');
    }
    // Выход
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home');
    }
}
