<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
    {
        return view('user.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function handleRegister(RegisterRequest $request)
    {
        $data = $request->all();
        if ($this->userService->register($data)) {
            $regis_success = trans('user.register_success');
            return redirect()->route('user.login', compact('regis_success'));
        }
        return redirect()->route('user.user.create')->with('error', trans('user.register_error'));
    }
}
