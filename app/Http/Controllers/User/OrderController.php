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
        $validator = \Validator::make($request->all(), [
            'customer.userId' => 'exists:users,id',
            'customer.customerName' => 'required',
            'customer.phoneNumber' => 'required|numeric|min:10',
            'customer.shippingAddress' => 'required',
            'arrProduct.*.product.id' => 'required|exists:products,id',
            'arrProduct.*.color.id' => 'required|exists:colors,id',
            'arrProduct.*.color.name' => 'required|exists:colors,name',
            'arrProduct.*.size.id' => 'required|exists:sizes,id',
            'arrProduct.*.size.name' => 'required|exists:sizes,size',
            'code.name' => 'exists:codes,name',
        ]);
        if ($validator->fails()) {
            return response()->json(array('success' => false, 'message' => $validator->errors()->all()));
        }
        if (app(OrderService::class)->order($request->input('code'), $request->input('arrProduct'), $request->input('customer'))) {
            return response()->json(array('success' => true, 'message' => trans('checkout.message.success')));
        }
        return response()->json(array('success' => false, 'message' => trans('checkout.message.error')));
    }
}
