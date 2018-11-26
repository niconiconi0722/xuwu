<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChatroomsRepository;
use App\Models\Chat;

class ChatsController extends Controller
{
    protected $repository;

    public function __construct(ChatroomsRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $chat = $this->repository->newChat($request);

        return response()->json(['chat' => $chat], 201);
    }
}
