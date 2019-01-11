<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CodeService;
use App\Http\Requests\Admin\PostCodeRequest;

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
}
