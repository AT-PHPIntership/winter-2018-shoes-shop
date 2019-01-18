<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\CodeService;
use App\Models\Code;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCodeRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCodeRequest $request)
    {
        $data = $request->all();
        if ($this->codeService->store($data)) {
            return redirect()->route('admin.codes.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.codes.create')->with('error', trans('common.message.create_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Code $code code
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        if ($this->codeService->destroy($code)) {
            return redirect()->route('admin.codes.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.codes.index')->with('error', trans('common.message.delete_error'));
    }
}
