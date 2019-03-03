<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\UserService;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('handleLogout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    /**
     * Handle login process.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLogin(LoginRequest $request)
    {
        $data = $request->except(['_token']);
        if (app(UserService::class)->login($data)) {
            return redirect()->route('user.index');
        }
        return redirect()->route('user.login');
    }

    /**
     * Handle logout process.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLogout()
    {
        \Auth::logout();
        return redirect()->route('user.login');
    }
}
