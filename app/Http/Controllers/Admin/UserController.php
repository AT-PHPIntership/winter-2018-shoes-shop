<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\UserService;
use App\Http\Requests\Admin\PostUserRequest;
use App\Http\Requests\Admin\PutUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    /**
    * Contructer
    *
    * @param App\Service\UserService $userService userService
    *
    * @return void
    */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUserWithPaginate();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Display a listing of trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $users = $this->userService->getTrashWithPaginate();
        return view('admin.user.trash', compact('users'));
    }

    /**
     * Display a listing of trash.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        if ($this->userService->restore($id)) {
            return redirect()->route('admin.users.trash')->with('success', trans('common.message.restore_success'));
        }
        return redirect()->route('admin.users.trash')->with('error', trans('common.message.restore_error'));
    }

    /**
     * Force delete user
     *
     * @param int $id id
     *
     * @return boolean
     */
    public function forceDelete(int $id)
    {
        if ($this->userService->forceDelete($id)) {
            return redirect()->route('admin.users.trash')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.users.trash')->with('error', trans('common.message.delete_error'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storag
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostUserRequest $request)
    {
        $data = $request->all();
        if (!empty($this->userService->store($data))) {
            return redirect()->route('admin.users.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.users.create')->with('error', trans('common.message.create_error'));
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\User $user user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\User $user user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id == $user->id ||  $user->role_id != \App\Models\Role::ADMIN_ROLE) {
            return view('admin.user.edit', compact('user'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     * @param App\Models\User          $user    user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutUserRequest $request, User $user)
    {
        $data = $request->all();
        if (!empty($this->userService->update($data, $user))) {
            return redirect()->route('admin.users.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.users.edit', $user)->with('error', trans('common.message.edit_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $user user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($this->userService->destroy($user)) {
            return redirect()->route('admin.users.index')->with('success', trans('common.message.block_success'));
        }
        return redirect()->route('admin.users.index')->with('error', trans('common.message.block_error'));
    }
}
