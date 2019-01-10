<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const OTHER = 0;
    const MALE = 1;
    const FEMALE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'gender', 'address', 'phonenumber', 'avatar',
    ];
    
    /**
     * Profile belong to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the avatar.
     *
     * @param string $imageName imageName
     *
     * @return string
     */
    public function getAvatarAttribute($imageName)
    {
        if (empty($imageName)) {
            return config('define.path.default_avatar');
        }
        return '/upload/'.$imageName;
    }
}
