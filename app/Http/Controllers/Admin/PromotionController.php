<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\PostPromotionRequest;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.promotion.list');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostPromotionRequest $request)
    {
        $data = $request->all();
        dd($data);
        // if (!empty($this->codeService->store($data))) {
        //     return redirect()->route('admin.codes.index')->with('success', trans('common.message.create_success'));
        // } else {
        //     return redirect()->route('admin.codes.create')->with('error', trans('common.message.create_error'));
        // }
    }
}
