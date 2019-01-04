<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use File;

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
     * Store a newly created resource in storage.
     *
     * @param array $request request
     *
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

    /**
     * Upload Avatar
     *
     * @param string $avatar avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar($avatar)
    {
        if ($avatar != null) {
            $fileName = time().'-'.$avatar->getClientOriginalName();
            $avatar->move('upload', $fileName);
            return $fileName;
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request request
     * @param int                       $id      id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update($request,$id)
    {
        try {
            $user = User::findOrFail($id);
            $profile = Profile::findOrFail($id);
            $inputUser = [
                'role_id' => $request->role_id,
            ];
            if ($request->password != null) {
                $inputUser['password'] = bcrypt($request->password);
            }
            $user->update($inputUser);
            $inputProfile = [
                'user_id' => $user->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'address' => $request->address,
                'phonenumber' => $request->phonenumber,
            ];
            if ($request->hasFile('avatar')) {
                $inputProfile['avatar'] = $this->uploadAvatar($request->avatar);
                File::delete(public_path('upload/'.$profile->avatar));
            }
            $profile->update($inputProfile);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if($user->profile->avatar != null){
                File::delete(public_path('upload/'.$user->profile->avatar));
            }
            $user->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
}
