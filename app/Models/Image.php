<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'imageable_type', 'imageable_id'
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Get the image.
     *
     * @param string $path image name
     *
     * @return string
     */
    public function getPathAttribute($path)
    {
        return config('define.upload_folder').$path;
    }
}
