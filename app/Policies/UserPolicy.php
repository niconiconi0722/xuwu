<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends Policy
{
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function index(User $currentUser)
    {
        return $currentUser->isAdmin();
    }

    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->isAdmin() && ($currentUser->id !== $user->id);
    }

    public function authorityEdit(User $currentUser, User $user)
    {
        return $currentUser->isSuperAdmin() && ($currentUser->id !== $user->id);
    }
}
