<?php

namespace App\Services;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;

class ResetPasswordService
{
    /**
     * Send an email to your email address to reset password.
     *
     * @param array $data data
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($data)
    {
        $user = User::where('email', $data['email'])->first();
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
            $user->notify(new PasswordResetRequest($passwordReset->token));
            return true;
        }
        Session::flash('error', trans('user.check_error'));
        return false;
    }

    /**
     * Handle process reset password
     *
     * @param array $data data
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($data)
    {
        $passwordReset = PasswordReset::where('token', $data['token'])->first();
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            Session::flash('error', trans('user.check_error'));
        }
        $user->password = bcrypt($data['password']);
        $user->save();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return true;
    }
}
