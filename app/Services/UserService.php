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
    public function getAll()
    {
        $users = User::paginate(config('define.paginate.limit_rows'));
        return $users;
    }
}
