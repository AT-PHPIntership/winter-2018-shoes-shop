<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Get all data table users
     *
     * @return object
     */
    public function getUserWithPaginate()
    {
        return User::with(['role', 'profile'])->paginate(config('define.paginate.limit_rows'));
    }
}
