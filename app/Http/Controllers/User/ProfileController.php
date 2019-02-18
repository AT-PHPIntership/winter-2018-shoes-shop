<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Services\UserService;

class ProfileController extends Controller
{
    private $userService;

    /**
    * Contructer
    *
    * @param App\Service\UserService $userService userService
    *
    * @return void
    */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

   /**
     * Show profile information.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = \Auth::user();
        return view('user.auth.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProfile(ProfileRequest $request)
    {
        $data = $request->all();
        if ($this->userService->updateProfile($data)) {
            return redirect()->route('user.profile')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('user.profile')->with('error', trans('common.message.edit_error'));
    }

   /**
     * Show password form to change.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPassword()
    {
        $user = \Auth::user();
        return view('user.auth.password', compact('user'));
    }

    /**
     * Update password.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function handlePassword(PasswordRequest $request)
    {
        $data = $request->only('new_password');
        if ($this->userService->changePassword($data)) {
            return redirect()->route('user.profile')->with('success', trans('user.change_password_success'));
        }
        return redirect()->route('user.password')->with('error', trans('user.change_password_error'));
    }
}
