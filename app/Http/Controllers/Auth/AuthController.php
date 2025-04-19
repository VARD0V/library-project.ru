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
        $role_user = Role::where('code', 'user')->first();
        $path = null;
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
        }
        $user = User::create([
            ...$request->validated(),
            'avatar' => $path,
            'role_id' => $role_user->id,
        ]);
        // Аутентификация
        Auth::login($user);
        // Создание токена
        $token = $user->createToken('default')->plainTextToken;
        // Можно сохранить токен в поле, если надо
        $user->api_token = $token;
        $user->save();
        return redirect()->route('home');
    }
    // Показать форму входа
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
