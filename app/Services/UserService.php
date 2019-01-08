<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Log\Logger;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return object
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            if ($data['role_id'] === Role::ADMIN_ROLE && !isAdminLogin()) {
                return false;
            }
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
            DB::commit();
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
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
}
