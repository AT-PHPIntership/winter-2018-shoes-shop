<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\SocialAccountService;

class SocialController extends Controller
{
    protected $service;

    /**
     * Contructer.
     *
     * @param SocialAccountService $socialService get services
     *
     * @return void
     */
    public function __construct(SocialAccountService $socialService)
    {
        $this->service = $socialService;
    }
    /**
    * Create a redirect method to social api.
    *
    * @param collection $provider provider
    *
    * @return void
    */
    public function redirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Return a callback method from social api.
     *
     * @param collection $provider provider
     *
     * @return callback URL from social
     */
    public function callback($provider)
    {
        $user = $this->service->createOrGetUser($provider);
        auth()->login($user);
        return redirect()->to('/home');
    }
}
