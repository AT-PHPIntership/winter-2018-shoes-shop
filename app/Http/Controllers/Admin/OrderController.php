<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\OrderService;
use App\Models\Order;
use App\Http\Requests\Admin\PatchOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = app(OrderService::class)->getOrderWithPaginate();
        return view('admin.order.list', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $order = app(OrderService::class)->getOrderById($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchOrderRequest $request request
     * @param Order             $order   order
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PatchOrderRequest $request, Order $order)
    {
        $data = $request->all();
        if (app(OrderService::class)->update($data, $order)) {
            return redirect()->route('admin.orders.show', ['id' => $order->id])->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.orders.show', ['id' => $order->id])->with('error', trans('common.message.edit_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order order
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if (app(OrderService::class)->destroy($order)) {
            return redirect()->route('admin.orders.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->back()->with('error', trans('common.message.delete_error'));
    }
}
