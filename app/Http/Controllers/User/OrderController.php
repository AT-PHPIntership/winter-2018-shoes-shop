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

}
