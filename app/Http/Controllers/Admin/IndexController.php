<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\StatisticalService;
use App\Models\Order;
use Carbon\Carbon;

class IndexController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrTotal = app(StatisticalService::class)->getTotal();
        $arrRevenue = app(StatisticalService::class)->getRevenue();
        $arrTopSell = app(StatisticalService::class)->getTopSell();
        $arrQuantityOrder = app(StatisticalService::class)->getQuantityOrderByStatus();
        return view('admin.index', compact(['arrTotal', 'arrRevenue', 'arrTopSell', 'arrQuantityOrder']));
    }
}
