<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class ProfileController extends Controller
{
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
     * @param App\Models\User          $user    user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request);
        // $data = $request->all();
        // if ($this->userService->updateProfile($data)) {
        //     return redirect()->route('user.profile')->with('success', trans('common.message.edit_success'));
        // }
        // return redirect()->route('user.profile', $user)->with('error', trans('common.message.edit_error'));
    }
}
