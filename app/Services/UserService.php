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
        return User::paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Get info user
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }
}
