<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;

class OrderController extends Controller
{
    /**
     * Show cart
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        return view('user.pages.cart');
    }
}
