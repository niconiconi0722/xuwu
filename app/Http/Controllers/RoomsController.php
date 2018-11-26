<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChatroomsRepository;
use App\Models\Room;
use App\Models\Chat;
use App\Models\User;

use Auth;

class RoomsController extends Controller
{
    protected $repository;

    public function __construct(ChatroomsRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function index()
    {
        return view('rooms.index');
    }

    public function show(Room $room)
    {
        $chats = Chat::orderBy('created_at', 'desc')->get();
        return view('rooms.show', compact('chats'));
    }

    public function join(Room $room)
    {
        if (! $this->repository->isInRoom(Auth::user(), $room)) {
            $user = Auth::user();
            $this->repository->attachUserToRoom($user, $room);
            $this->repository->sendJoinMessage($user, $room);
        }
    }

    public function leave(Room $room)
    {
        $user = Auth::user();
        $this->repository->detachUserFromRoom($user, $room);
        $this->repository->sendLeaveMessage($user, $room);
    }
}
