<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Models\Chat;

// 如果implements ShouldBroadcast在用户进入房间时用户会显示两次用户进入房间
class RoomHasNewChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel("chatroom.{$this->chat->room_id}.channel");
    }

    public function broadcastWith()
    {
        $data = $this->chat->toArray();

        if ($this->chat->user_id) {
            $userOfChat = [
                'user' => $this->chat->user,
            ];
            $data = array_merge($userOfChat, $data);
        }

        $return['chat'] = $data;

        return $return;
    }
}