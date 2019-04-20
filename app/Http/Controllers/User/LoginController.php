<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\UserService;
use Auth;

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
        session(['link' => url()->previous()]);
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
        $data = $request->only('email', 'password');
        if (app(UserService::class)->login($data)) {
            return redirect(session('link'));
        }
        return redirect()->route('user.login')->with('success', trans('login.invalid_account'))->withInput();
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
