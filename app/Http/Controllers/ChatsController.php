<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use App\Repositories\ChatroomsRepository;
use App\Models\Room;
use App\Models\Chat;

class ChatsController extends Controller
{
    protected $repository;

    public function __construct(ChatroomsRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function store(ChatRequest $request, Room $room)
    {
        $chat = $this->repository->newChat($request, $room);

        return response()->json(['chat' => $chat], 201);
    }
}