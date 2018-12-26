<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Get User Object
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
