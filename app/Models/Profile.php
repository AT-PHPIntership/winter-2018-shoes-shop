<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const MALE = 1;
    const FEMALE = 0;
    const OTHER = 2;

    /**
     * Profile belong to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
