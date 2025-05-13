<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return redirect()->route('articles.index');
})->name('home');

// Ресурсные маршруты
Route::resource('articles', ArticleController::class);
Route::resource('ai', AIController::class);
Route::resource('discussions', DiscussionController::class);

// Регистрация и авторизация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');


// Защищенные маршруты (требуют аутентификации)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'show'])->name('profile');
    Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resource('comments', CommentController::class)->middleware('auth');

