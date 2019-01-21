<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\OrderService;

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
}
