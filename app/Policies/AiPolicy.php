<?php

namespace App\Policies;

use App\Models\ArtificialIntelligence;
use App\Models\User;

class AiPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, ArtificialIntelligence $ai): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, ArtificialIntelligence $ai): bool
    {
        return $user->id === $ai->user_id || $user->role->code === 'admin';
    }

    public function delete(User $user, ArtificialIntelligence $ai): bool
    {
        return $user->role->code === 'admin';
    }
}
