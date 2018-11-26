<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Chat;

use App\Events\RoomHasNewChatEvent;
use Auth;

class ChatroomsRepository
{
    public function index()
    {
        $rooms = Room::orderBy('is_fixed', 'desc')->orderBy('created_at', 'desc')->paginate(22);

        return $rooms;
    }

    public function isInRoom($user, $room)
    {
        return $room->users->contains($user);
    }

    public function newRoom($request)
    {
        $room = new Room();

        $room->name = $request->name;
        $room->description = $request->description;
        $room->save();

        return $room;
    }

    public function newChat($request, $room, bool $isSystemMessage = false)
    {
        $chat = new Chat();

        if (! $isSystemMessage) {
            $chat->user_id = Auth::id();
        }
        $chat->room_id = $room->id;
        $chat->content = $request->content;
        $chat->save();

        broadcast(new RoomHasNewChatEvent($chat));

        return $chat;
    }

    public function sendJoinMessage($user, $room)
    {
        $this->sendSystemMessage($room, $user->ni_cheng . '进入了房间');
    }

    public function sendLeaveMessage($user, $room)
    {
        $this->sendSystemMessage($room, $user->ni_cheng . '离开了房间');
    }

    protected function sendSystemMessage($room, $content)
    {
        $request = (object) ['content' => $content];
        $chat = $this->newChat($request, $room, true);
    }

    public function attachUserToRoom($user, $room)
    {
        $room->users()->attach($user->id);
        $room->increment('user_count');
    }

    public function detachUserFromRoom($user, $room)
    {
        $room->users()->detach($user->id);
        $room->decrement('user_count');
    }
}
