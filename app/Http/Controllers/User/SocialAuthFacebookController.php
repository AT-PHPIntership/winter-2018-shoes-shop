<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\SocialFacebookAccountService;

class SocialAuthFacebookController extends Controller
{
    /**
    * Create a redirect method to facebook api.
    *
    * @return void
    */
    public function redirect()
    {
        return \Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @param \App\Services\SocialFacebookAccountService $service Facebook account
     * @param \Illuminate\Http\Request                   $request request
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service, Request $request)
    {
        if (! $request->input('code')) {
            return redirect('login')->withErrors('Login failed: '.$request->input('error').' - '.$request->input('error_reason'));
        }
        $user = $service->createOrGetUser(\Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/');
    }
}
