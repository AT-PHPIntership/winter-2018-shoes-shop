<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use App\Models\PasswordReset;
use App\Http\Requests\User\EmailRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use Carbon\Carbon;

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
        return view('user.auth.request_password');
    }

    /**
     * Send an email to your email address to reset password.
     *
     * @param ResetPasswordRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('user.password.request')->with('error', trans('user.invalid_email'));
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
            ]
        );
        if ($user && $passwordReset) {
            $user->notify( new PasswordResetRequest($passwordReset->token));
            return redirect()->route('user.password.request')->with('success',trans('user.sent_email'));
        }
        return redirect()->route('user.password.request')->with('error', trans('user.check_error'));
    }

    /**
     * Show the application's reset password form.
     *
     * @param string $token token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset) {
            return redirect()->route('user.password.request')->with('errer', trans('user.check_error'));
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return redirect()->route('user.password.request')->with('errer', trans('user.check_error'));
        }
        return view('user.auth.reset_password', compact('token'));
    }

    /**
     * Handle process reset password
     *
     * @param ResetPasswordRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function reset(ResetPasswordRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return redirect()->route('user.password.request')->with('errer', trans('user.check_error'));
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return redirect()->route('user.login');
    }
}
