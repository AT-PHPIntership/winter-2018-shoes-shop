<?php

namespace App\Services;

use Auth;

class LoginService
{
    /**
    * Handle login by user account
    *
    * @param array $data from request
    *
    * @return redirect route
    */
    public function userLogin(array $data)
    {
        if (Auth::attempt($data)) {
            return redirect()->route('user.index');
        } else {
            session()->flash("error", trans('login.error'));
            return redirect()->back();
        }
    }
}
