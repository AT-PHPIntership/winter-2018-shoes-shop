<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\StatisticalService;
use Illuminate\Http\Request;
use Excel;

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
        if($request->ajax()){
            $orders = app(StatisticalService::class)->getOrdersBetweenTwoDate(date("Y/m/d", strtotime($request->input('fromDate'))), date("Y/m/d", strtotime($request->input('toDate'))));
            return $orders;
        }
        if ($request->has(['from_date', 'to_date'])) {
            $fromDate = date("Y/m/d", strtotime($request->input('from_date')));
            $toDate = date("Y/m/d", strtotime($request->input('to_date')));
            $data = app(StatisticalService::class)->getOrdersBetweenTwoDate($fromDate, $toDate);
            return Excel::create(trans('statistical.revenue.title-export').'-'.$fromDate.'-'.$toDate, function($excel) use ($data) {
                $excel->sheet('sheet', function($sheet) use ($data)
                {
                    $sheet->cell('A1', function($cell) {$cell->setValue(trans('statistical.revenue.id'));});
                    $sheet->cell('B1', function($cell) {$cell->setValue(trans('statistical.revenue.order_id'));});
                    $sheet->cell('C1', function($cell) {$cell->setValue(trans('statistical.revenue.user_name'));});
                    $sheet->cell('D1', function($cell) {$cell->setValue(trans('statistical.revenue.code_name'));});
                    $sheet->cell('E1', function($cell) {$cell->setValue(trans('statistical.revenue.order_created_at'));});
                    $sheet->cell('F1', function($cell) {$cell->setValue(trans('statistical.revenue.order_delivered_at'));});
                    $sheet->cell('G1', function($cell) {$cell->setValue(trans('statistical.revenue.order_total_amount'));});
                    if (!empty($data)) {
                        $total = 0;
                        $loca = 0;
                        foreach ($data as $key => $value) {
                            $total += $value['order_total_amount'];
                            $i = $key + 2;
                            $loca = $key + 3;
                            $sheet->cell('A'.$i, $value['id']); 
                            $sheet->cell('B'.$i, $value['order_id']); 
                            $sheet->cell('C'.$i, $value['user_name']);
                            $sheet->cell('D'.$i, $value['code_name']); 
                            $sheet->cell('E'.$i, $value['order_created_at']); 
                            $sheet->cell('F'.$i, $value['order_delivered_at']);
                            $sheet->cell('G'.$i, $value['order_total_amount']);
                        }
                        $sheet->cell('A'.$loca, function($cell) {$cell->setValue(trans('statistical.revenue.order_total_all'));});
                        $sheet->cell('G'.$loca, $total);
                    }
                });
            })->download('csv');
        } else {
            return view('admin.statistical.revenue');
        }
    }

    /**
     * Show inventory
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $products = app(StatisticalService::class)->getInventory();
        return view('admin.statistical.product', compact('products'));
    }
}
