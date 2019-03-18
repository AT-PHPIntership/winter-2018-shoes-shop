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
use App\Services\ResetPasswordService;

class PasswordResetController extends Controller
{
    /**
     * The category Service implementation.
     *
     * @var resetPasswordService
     */
    protected $resetPasswordService;

    /**
     * Create a new controller instance.
     *
     * @param ResetPasswordService $resetPasswordService resetPasswordService
     *
     * @return void
     */
    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->middleware('guest');
        $this->resetPasswordService = $resetPasswordService;
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
        $data = $request->only('email');
        if ($this->resetPasswordService->sendEmail($data)) {
            return redirect()->route('user.password.request')->with('success', trans('user.sent_email'));
        }
        return redirect()->route('user.password.request');
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
        $data = $request->only('password', 'token');
        if ($this->resetPasswordService->resetPassword($data)) {
            return redirect()->route('user.login');
        }
        return redirect()->route('user.password.request');
    }
}
