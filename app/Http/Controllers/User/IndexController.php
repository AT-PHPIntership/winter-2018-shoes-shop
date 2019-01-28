<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pages.index');
    }
}
