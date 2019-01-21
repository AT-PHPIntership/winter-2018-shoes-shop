<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    protected $orderService;

    /**
    * Contructer
    *
    * @param App\Service\OrderService $orderService orderService
    *
    * @return void
    */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderService->getOrderWithPaginate();
        return view('admin.order.list', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order order
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }
}
