<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\StatisticalService;

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
        // $revenue = app(StatisticalService::class)->getRevenue();
        return view('admin.index', compact('arrTotal'));
    }
}
