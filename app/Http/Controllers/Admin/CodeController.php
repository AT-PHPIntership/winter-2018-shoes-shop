<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CodeService;
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
