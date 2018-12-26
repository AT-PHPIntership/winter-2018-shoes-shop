<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Get User Object
     *
     * @return object
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
