<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\StatisticalService;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * Request $request request 
     *
     * @return \Illuminate\Http\Response
     */
    public function revenue(Request $request)
    {
        if ($request->has(['from_date', 'to_date'])) {
            $orders = app(StatisticalService::class)->getOrdersBetweenTwoDate(date("Y/m/d", strtotime($request->input('from_date'))), date("Y/m/d", strtotime($request->input('to_date'))));
            return view('admin.statistical.revenue', compact('orders'));
        } else {
            return view('admin.statistical.revenue');
        }
    }
}
