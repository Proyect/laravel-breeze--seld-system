<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $target): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $auth, User $target): bool
    {
        return $auth->isAdmin();
    }

    public function delete(User $auth, User $target): bool
    {
        return $auth->isAdmin() && $auth->id !== $target->id;
    }
}
