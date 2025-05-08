<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;

class DiscussionPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Discussion $discussion): bool
    {
        return true;
    }
    // Только авторизованные пользователи могут создавать
    public function create(User $user): bool
    {
        return $user !== null;
    }
    // Только автор может редактировать
    public function update(User $user, Discussion $discussion): bool
    {
        return $user->id === $discussion->author_id;
    }
    // Удаление — либо автор, либо админ
    public function delete(User $user, Discussion $discussion): bool
    {
        return $user->id === $discussion->author_id || $user->role->code === 'admin';
    }
}
