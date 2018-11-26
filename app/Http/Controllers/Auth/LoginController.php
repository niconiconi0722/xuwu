<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Repositories\EntryRepository;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $login['username'] = $request->username;
        $login['password'] = $request->password;

        if(Auth::attempt($login)){
            return redirect()->intended();
        }else{
            session()->flash('danger', '账号不存在或密码错误');
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
