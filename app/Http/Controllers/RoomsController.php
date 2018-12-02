<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
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

    public function store(RoomRequest $request)
    {
        $room = $this->repository->newRoom($request);
        $this->repository->joinRoom(Auth::user(), $room);
        $room->changeHost(Auth::user());

        return redirect()->route('rooms.show', $room->id);
    }

    public function show(Room $room)
    {
        $chats = $this->repository->getChatsInRoom($room);

        return view('rooms.show', compact('room', 'chats'));
    }

    public function update(Room $room, RoomRequest $request)
    {
        $this->authorize($room, 'update');
        $room = $this->repository->updateRoom($room, $request);

        return response()->json([
            'success' => true,
            'room' => $room,
        ]);
    }

    public function destroy(Room $room)
    {
        $this->authorize('destroy', $room);
        $this->repository->destroyRoom($room);

        return response()->json([
            'success' => true,
        ]);
    }

    public function syncUser(Room $room, Request $users)
    {
        $this->repository->roomShouldHasUsers($users, $room);
    }

    public function join(Room $room)
    {
        $user = Auth::user();

        if ($room->hasUser($user)) {
            return response()->json([
                'success' => true,
                'message' => '用户已在此房间',
                'link' => route('rooms.show', $room->id),
            ]);
        }

        if ($room->isFull()) {
            return response()->json([
                'success' => false,
                'message' => '房间已满',
            ]);
        }

        $this->repository->joinRoom($user, $room);

        return response()->json([
            'success' => true,
            'message' => '用户进入了房间',
            'link' => route('rooms.show', $room->id),
        ]);
    }

    public function leave(Room $room)
    {
        $user = Auth::user();
        $this->repository->leaveRoom($user, $room);
    }

    public function knock(Room $room)
    {
        $user = Auth::user();
        $this->repository->sendknockMessage($user, $room);

        return response()->json([
            'success' => false,
            'message' => '已发出增加人数的请求，请稍后刷新查看是否能进入房间',
        ]);
    }

    public function kick(Room $room, User $user)
    {
        $this->authorize('kick', [$room, $user]);
        $this->repository->kick($user, $room);
    }
}
