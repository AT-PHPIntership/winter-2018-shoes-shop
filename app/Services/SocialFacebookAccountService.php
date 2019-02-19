<?php

namespace App\Services;

use App\Models\SocialFacebookAccount;
use App\Models\User;
use App\Models\Profile;
use Laravel\Socialite\Contracts\User as ProviderUser;
use DB;

class SocialFacebookAccountService
{
    /**
     * Create or get user from Facebook account
     *
     * @param \Laravel\Socialite\Contracts\User $providerUser user
     *
     * @return App\Models\User
     */
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
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
