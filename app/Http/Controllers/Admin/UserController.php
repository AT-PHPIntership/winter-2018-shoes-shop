<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\UserService;
use App\Http\Requests\Admin\PostUserRequest;
use App\Models\User;

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
        $this->userService->store($data);
        return redirect()->route('admin.users.index')->with('success', trans('common.message.create_success'));
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
        return view('admin.user.edit', compact('user'));
    }
}
