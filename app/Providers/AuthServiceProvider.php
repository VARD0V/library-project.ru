<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ArtificialIntelligence;
use App\Models\Comment;
use App\Policies\AiPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
        ArtificialIntelligence::class => AiPolicy::class,
        Comment::class => CommentPolicy::class,
    ];
    public function boot(): void
    {
        // Регистрируем все политики
        $this->registerPolicies();
        // Опционально: можно добавить глобальные правила доступа через Gate
        // Например, проверка роли администратора
        Gate::define('isAdmin', function ($user) {
            return $user->role->code === 'admin';
        });
    }
}
