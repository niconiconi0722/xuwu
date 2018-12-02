<?php

use App\Models\Room;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chatroom.{room}.channel', function ($user, Room $room) {
    if ($room->hasUser($user)) {
        return $user->toArray();
    }
});
