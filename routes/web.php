<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DiscussionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::resource('articles', ArticleController::class);
Route::resource('ai',       AIController::class);
Route::resource('discussions',       DiscussionController::class);
