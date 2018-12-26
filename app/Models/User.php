<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get Profile Object
     *
     * @return object
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Get Role Object
     *
     * @return object
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
