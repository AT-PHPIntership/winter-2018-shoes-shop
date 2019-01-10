<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CodeService;
use App\Http\Requests\Admin\PostCodeRequest;
use App\Models\Code;

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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCodeRequest $request)
    {
        $data = $request->all();
        if (!empty($this->codeService->store($data))) {
            return redirect()->route('admin.codes.index')->with('success', trans('common.message.create_success'));
        } else {
            return redirect()->route('admin.codes.create')->with('error', trans('common.message.create_error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Code $code code
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        return view('admin.code.edit', compact('code'));
    }
}
