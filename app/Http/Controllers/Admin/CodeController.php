<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CodeService;

class CodeController extends Controller
{
    private $codeService;

    /**
    * Contructer
    *
    * @param App\Service\CodeService $codeService codeService
    *
    * @return void
    */
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = $this->codeService->getCodeWithPaginate();
        return view('admin.code.list', compact('codes'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.code.create');
    }

     /**
     * Store a newly created resource in storag
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(convertDTLToDT('1998-11-11T15:15'));
        dd(convertDTToDTL('1998-11-11 15:15:00'));
        // $a = '1998-11-11 15:15:00';
        // $a = \Carbon\Carbon::parse($a)->format('Y-m-d H:i');
        // $a = str_replace(' ', 'T', $a);
        // dd($a);

        // $time = strtotime('1998-11-11 15:15:00');
        // $dateInLocal = date("Y-m-d H:i", $time);
        // $dateInLocal = str_replace(' ', 'T', $dateInLocal);

        // $data = $request->all();
        // $time = strtotime($data['end_date']);
        // $dateInLocal = date("Y-m-d H:i:s", $time);
        // '1998-11-11T15:15'
        // $local = date('Y-m-d H:i:s T')1998-11-11 15:15:00.0;
        // $local = date("Y-m-d H:i:s", '2019-01-08 04:16:22');
        // dd($dateInLocal);
        
    }
}
