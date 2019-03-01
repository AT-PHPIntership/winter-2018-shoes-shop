<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use App\Models\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application's request password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRequestForm()
    {
        return view('user.auth.requestpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'token' => 'required|string'
        // ]);

        // dd($request->all());
        $user->notify(new PasswordResetRequest($resetRequest));
        dd('Chúng tôi đã gửi tới email của bạn link reset mật khẩu!');
    }
}
