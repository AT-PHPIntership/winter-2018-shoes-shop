<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\User\ProfileRequest;
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
}
