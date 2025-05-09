<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        if (Auth::check()) {
            $user = Auth::user();
            $discussions = $user->discussions; // или Discussion::where('author_id', $user->id)->get();
            return view('auth.profile', compact('discussions'));
        }
        return redirect()->route('login');
    }
    // Выход
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home');
    }
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        // Если загружен новый аватар
        if ($request->hasFile('avatar_url')) {
            // Удаляем старый аватар, если он существует
            if ($user->avatar_url) {
                Storage::disk('public')->delete($user->avatar_url);
            }

            // Загружаем новый аватар
            $path = $request->file('avatar_url')->store('avatars', 'public');

            // Обновляем поле avatar_url с новым путём
            $user->avatar_url = $path;
        }

        // Если введен новый пароль, то обновляем его
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Хешируем новый пароль
        }

        // Обновляем остальные поля пользователя
        $user->update($request->except(['password', 'avatar_url']));

        return redirect()->route('profile')->with('success', 'Профиль успешно обновлён.');
    }
}
