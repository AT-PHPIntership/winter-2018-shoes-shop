<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Update the specified resource in storage.
     *
     * @param array           $data data
     * @param App\Models\User $user user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, User $user)
    {
        DB::beginTransaction();
        try {
            if ($user->role_id == Role::ADMIN_ROLE && ($data['role_id'] != Role::ADMIN_ROLE || Auth::user()->id != $user->id)) {
                return false;
            }
            $inputUser = [
                'role_id' => $data['role_id'],
            ];
            $inputProfile = [
                'user_id' => $user->id,
                'name' => $data['name'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phonenumber' => $data['phonenumber'],
            ];
            if (isset($data['avatar'])) {
                $inputProfile['avatar'] = $this->uploadAvatar($data['avatar']);
                File::delete(public_path('upload/'.$user->profile->avatar));
            }
            $user->profile->update($inputProfile);
            $user->update($inputUser);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $user user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        try {
            if ($user->role_id != Role::ADMIN_ROLE) {
                if ($user->profile->avatar) {
                    File::delete(public_path('upload/'.$user->profile->avatar));
                }
                return $user->delete();
            }
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }

    /**
     * Update the profile.
     *
     * @param array $data data
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(array $data)
    {
        $user = \Auth::user();
        DB::beginTransaction();
        try {
            $inputProfile = [
                'name' => $data['name'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phonenumber' => $data['phonenumber'],
            ];
            if (isset($data['avatar'])) {
                $inputProfile['avatar'] = $this->uploadAvatar($data['avatar']);
                File::delete(public_path('upload/'.$user->profile->avatar));
            }
            $user->profile->update($inputProfile);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
}
