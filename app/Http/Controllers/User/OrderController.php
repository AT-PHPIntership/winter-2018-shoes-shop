<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Order;

class OrderController extends Controller
{
   /**
     * Show orders list of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->get();
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
        $user_id = \Auth::user()->id;
        $order = Order::where('user_id', $user_id)->findOrFail($id);
        return view('user.pages.order.detail', compact('order'));
    }
}
