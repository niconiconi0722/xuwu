<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Repositories\EntryRepository;
use App\Repositories\LoginAttemptCountRepository;
use App\Http\Requests\LoginRequest;

use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginAttemptCountRepository $repository)
    {
        $this->middleware('guest')->except('logout');
        $this->repository = $repository;
    }

    public function showLoginForm()
    {
        $should_captcha = $this->repository->shouldCaptcha();
        return view('auth.login', compact('should_captcha'));
    }

    public function login(LoginRequest $request)
    {
        $login['username'] = $request->username;
        $login['password'] = $request->password;

        if (Auth::attempt($login)) {
            $this->repository->resetCount();
            return redirect()->intended();
        } else {
            $this->repository->addCount();
            $request->session()->flash('danger', '账号不存在或密码错误');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        (new EntryRepository())->exit();
        return redirect()->route('index');
    }
}