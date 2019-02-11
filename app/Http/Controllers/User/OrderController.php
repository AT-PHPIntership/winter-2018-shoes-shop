<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\CodeService;

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

    /**
     * Apply code
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function applyCode(Request $request)
    {
        return app(CodeService::class)->applyCode($request->input('code'), $request->input('productIds'));
    }
}
