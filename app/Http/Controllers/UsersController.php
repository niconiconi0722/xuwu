<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Repositories\UsersRepository;

use Auth;

class UsersController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);

        $this->middleware('guest', [
        'only' => ['create']
        ]);

        $this->repository = $repository;
    }

    public function index()
    {
        $this->authorize('index', User::class);
        $users = $this->repository->index();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $this->repository->store($request);

        return redirect()->intended()->with('success', '注册成功');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $this->authorize('update', $user);

        if ($request->img != null) {
            $this->repository->updateIcon($user, $request->img);
            return response()->json([
                'status' => 1,
                'success' => true,
                'src' => $user->iconpath,
            ]);
        }
        $this->repository->update($user, $request);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $this->repository->destroy($user);

        return redirect()->back();
    }
}
