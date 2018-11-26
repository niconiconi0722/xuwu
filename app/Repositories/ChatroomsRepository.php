<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Chat;

use App\Events\RoomHasNewChatEvent;
use Auth;

class ChatroomsRepository
{
    public function isInRoom($user, $room)
    {
        return $room->users->contains($user);
    }

    public function sendJoinMessage($user, $room)
    {
        $this->sendSystemMessage($user->ni_cheng . '进入了房间');
    }

    public function sendLeaveMessage($user, $room)
    {
        $this->sendSystemMessage($user->ni_cheng . '离开了房间');
    }

    protected function sendSystemMessage($content)
    {
        $request = (object) ['content' => $content];
        $chat = $this->newChat($request, true);
    }

    public function newChat($request, bool $isSystemMessage = false)
    {
        $chat = new Chat();

        if (! $isSystemMessage) {
            $chat->user_id = Auth::id();
        }
        $chat->room_id = 1;
        $chat->content = $request->content;
        $chat->save();

        broadcast(new RoomHasNewChatEvent($chat));

        return $chat;
    }

    public function attachUserToRoom($user, $room)
    {
        $room->users()->attach($user->id);
    }

    public function detachUserFromRoom($user, $room)
    {
        $room->users()->detach($user->id);
    }
}
