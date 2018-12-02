<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Room;

class RoomPolicy extends Policy
{
    public function update(User $user, Room $room)
    {
        return $room->hostIs($user);
    }

    public function destroy(User $user, Room $room)
    {
        return $room->hostIs($user) || $user->isAdmin();
    }

    public function kick(User $currentUser, Room $room, User $user)
    {
        return ($room->hostIs($user) || $currentUser->isAdmin()) && ($currentUser->id != $user->id);
    }
}
