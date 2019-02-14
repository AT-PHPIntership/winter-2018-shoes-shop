<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\CodeService;
use App\Http\Requests\User\PostCheckoutRequest;
use App\Services\OrderService;

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
        return app(CodeService::class)->getDecreaseTotalAmount($request->input('code'), $request->input('products'));
    }

    /**
     * Show checkout
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        return view('user.pages.checkout');
    }

    /**
     * Handle checkout
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function handleCheckout(Request $request)
    {
        // $a = $request->input('code');
        // \Log::debug($request->input('code'));
        return app(OrderService::class)->order($request->input('code'), $request->input('arrProduct'), $request->input('customer'));
    }
}
