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
        $users = User::with('profile')->with('role')->paginate(config('define.paginate.limit_rows'));
        return $users;
    }

    /**
     * Get info user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
}
