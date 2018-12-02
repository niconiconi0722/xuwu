<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Room;
use App\Models\Chat;

use App\Events\RoomHasNewChatEvent;
use App\Events\AttachedUserToRoomEvent;
use App\Events\DetachedUserFromRoomEvent;
use App\Events\UserBeKickedEvent;
use App\Events\HostChangedEvent;

use Auth;

class ChatroomsRepository
{
    public function index()
    {
        $rooms = Room::orderBy('is_fixed', 'desc')->orderBy('created_at', 'desc')->paginate(22);

        return $rooms;
    }

    public function getChatsInRoom($room)
    {
        return $room->chats()->orderBy('created_at', 'desc')->limit(50)->get();
    }

    public function roomShouldHasUsers($users, $room)
    {
        $user_id_array = array_column($users->toArray(), 'id');

        foreach ($room->users as $userInDatabase) {
            if (! in_array($userInDatabase->id, $user_id_array)) {
                $this->detachUserFromRoom($userInDatabase, $room);
                $this->sendDisconnectMessage($userInDatabase, $room);
            }
        }
    }

    public function newRoom($request)
    {
        $room = $this->saveRoom(new Room(), $request);
        return $room;
    }

    public function updateRoom($room, $request)
    {
        $room = $this->saveRoom($room, $request);
        return $room;
    }

    protected function saveRoom($room, $request)
    {
        $room->name = $request->name;
        $room->description = $request->description;
        $room->max_users = $request->max_users;
        $room->save();

        return $room;
    }

    public function destroyRoom($room)
    {
        $room->delete();
    }

    public function joinRoom($user, $room)
    {
        $this->attachUserToRoom($user, $room);
        $this->sendJoinMessage($user, $room);
    }

    public function leaveRoom($user, $room)
    {
        $this->sendLeaveMessage($user, $room);
        $this->detachUserFromRoom($user, $room);
    }

    public function kick($user, $room)
    {
        $this->sendKickMessage($user, $room);
        broadcast(new UserBeKickedEvent($user, $room));
        $this->detachUserFromRoom($user, $room);
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

    public function sendDisconnectMessage($user, $room)
    {
        $this->sendSystemMessage($room, $user->ni_cheng . '断开了连接');
    }

    public function sendKnockMessage($user, $room)
    {
        $this->sendSystemMessage($room, $user->ni_cheng . '想进入房间');
    }

    public function sendKickMessage($user, $room)
    {
        $this->sendSystemMessage($room, $user->ni_cheng . '被移除房间');
    }

    public function sendHostChangedMessage($user, $room)
    {
        $this->sendSystemMessage($room, '房主变为了' . $user->ni_cheng);
    }

    protected function sendSystemMessage($room, $content)
    {
        $request = (object) ['content' => $content];
        $chat = $this->newChat($request, $room, true);
    }

    protected function attachUserToRoom($user, $room)
    {
        $room->users()->attach($user->id);
        $room->increment('user_count');
        broadcast(new AttachedUserToRoomEvent($user, $room))->toOthers();
    }

    protected function detachUserFromRoom($user, $room)
    {
        $room->users()->detach($user->id);
        $room->decrement('user_count');
        broadcast(new DetachedUserFromRoomEvent($user, $room))->toOthers();

        if ((! $this->destroyNullRoomIfNeed($room)) && $room->hostIs($user)) {
            $this->changeHostOfRoom($room);
        }
    }

    // 当删除了房间时返回true，否则返回false
    public function destroyNullRoomIfNeed($room)
    {
        if (($room->user_count === 0) && (! $room->is_fixed)) {
            $room->delete();
            return true;
        } else {
            return false;
        }
    }

    public function changeHostOfRoom($room, $user = null)
    {
        $user = $room->changeHost($user);
        if ($user) {
            $this->sendHostChangedMessage($user, $room);
            broadcast(new HostChangedEvent($user, $room));
        }
    }
}
