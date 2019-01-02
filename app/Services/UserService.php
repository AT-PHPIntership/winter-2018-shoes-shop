<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $request request
     * @return boolean
     */
    public function store($request)
    {
        try {
            $user = User::create([
                'role_id' => $request->role_id,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Profile::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'address' => $request->address,
                'phonenumber' => $request->phonenumber,
                'avatar' => $this->uploadAvatar($request->avatar),
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function uploadAvatar($avatar)
    {
        if ($avatar != null) {
            $fileName = time().'-'.$avatar->getClientOriginalName();
            $avatar->move('upload', $fileName);
            return $fileName;
        }
        return null;
    }
}
