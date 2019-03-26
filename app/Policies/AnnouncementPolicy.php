<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Announcement;

class AnnouncementPolicy extends Policy
{
    public function save(User $user)
    {
        return $user->isAdmin();
    }

    public function changePriority(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function destroy(User $user, Announcement $announcement)
    {
        return $user->isAuthorOf($announcement)
                || $user->isSuperAdmin();
    }
}