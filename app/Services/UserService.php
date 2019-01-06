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
        return User::paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return boolean
     */
    public function store($data)
    {
        try {
            $user = User::create([
                'role_id' => $data['role_id'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            Profile::create([
                'user_id' => $user['id'],
                'name' => $data['name'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phonenumber' => $data['phonenumber'],
                'avatar' => isset($data['avatar']) ? $this->uploadAvatar($data['avatar']) : null,
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Upload Avatar
     *
     * @param string $avatar avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar($avatar)
    {
        $fileName = time().'-'.$avatar->getClientOriginalName();
        $avatar->move('upload', $fileName);
        return $fileName;
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
