<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use App\Services\CodeService;
use App\Http\Requests\User\PostCheckoutRequest;
use App\Services\OrderService;
use App\Services\ProductService;

class OrderController extends Controller
{
    /**
     * The order Service implementation.
     *
     * @var orderService
     */
    protected $orderService;

    /**
     * Create a new controller instance.
     *
     * @param OrderService $orderService orderService
     *
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Show orders list of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderService->getAuthOrderWithPaginate();
        return view('user.pages.order.list', compact('orders'));
    }
    /**
     * Show order detail to follow
     *
     * @param int $id order id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $order = $this->orderService->getAuthOrderById($id);
        return view('user.pages.order.detail', compact('order'));
    }
    
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
     * Show confermation
     *
     * @return \Illuminate\Http\Response
     */
    public function confermation()
    {
        return view('user.pages.confermation');
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
            // 'arrProduct.*.product.id' => 'required|exists:products,id',
            // 'arrProduct.*.color.id' => 'required|exists:colors,id',
            // 'arrProduct.*.color.name' => 'required|exists:colors,name',
            // 'arrProduct.*.size.id' => 'required|exists:sizes,id',
            // 'arrProduct.*.size.name' => 'required|exists:sizes,size',
            'code.name' => 'exists:codes,name',
        ]);
        if ($validator->fails()) {
            return response()->json(array('success' => false, 'type' => 'valid', 'message' => $validator->errors()->all()));
        }
        if (!empty($request->input('code.name')) && app(CodeService::class)->checkCodeWithUser($request->input('code.name'), $request->input('customer.userId'))) {
            return response()->json(array('success' => false, 'type' => 'code', 'message' => trans('checkout.message.err_used_code')));
        }
        $error = app(ProductService::class)->checkExistProducts($request->input('arrProduct'));
        if (count($error)) {
            return response()->json(array('success' => false, 'type' => 'product_exist', 'message' => $error));
        }
        $error = app(ProductService::class)->checkQuantityProducts($request->input('arrProduct'));
        if (count($error)) {
            return response()->json(array('success' => false, 'type' => 'product_inventory', 'message' => $error));
        }
        if (app(OrderService::class)->order($request->input('code'), $request->input('arrProduct'), $request->input('customer'))) {
            return response()->json(array('success' => true, 'message' => trans('checkout.message.success')));
        }
        return response()->json(array('success' => false, 'message' => trans('checkout.message.error')));
    }
}
