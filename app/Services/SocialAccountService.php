<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use App\Models\Profile;
use Laravel\Socialite\Contracts\User as ProviderUser;
use DB;

class SocialAccountService
{
    /**
     * Create or get user from social account
     *
     * @param collection $provider social account
     *
     * @return App\Models\User
     */
    public function createOrGetUser($provider)
    {
        $providerUser = \Socialite::driver($provider)->user();
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                DB::beginTransaction();
                try {
                    $user = User::create([
                        'role_id' => 2,
                    ]);
                    Profile::create([
                        'user_id' => $user->id,
                        'name' => $providerUser->name,
                        'avatar' => $providerUser->avatar,
                    ]);
                    DB::commit();
                } catch (Exception $e) {
                    Log::error($e);
                    DB::rollback();
                }
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
