<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use App\Services\OrderService;

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
}
