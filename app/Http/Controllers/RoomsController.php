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
        $this->middleware('auth', ['except' => 'index']);

        $this->repository = $repository;
    }

    public function index()
    {
        $rooms = $this->repository->index();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $room = $this->repository->newRoom($request);

        return redirect()->route('rooms.show', $room->id);
    }

    public function show(Room $room)
    {
        $chats = $room->chats()->orderBy('created_at', 'desc')->get();

        return view('rooms.show', compact('room', 'chats'));
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
