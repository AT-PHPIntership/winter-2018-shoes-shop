<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    /**
     * Get user from facebook account
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
