<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\PostPromotionRequest;
use App\Services\PromotionService;

class PromotionController extends Controller
{
    private $promotionService;
    /**
    * Contructer
    *
    * @param App\Service\promotionService $promotionService promotionService
    *
    * @return void
    */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

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
     * @param PostPromotionRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostPromotionRequest $request)
    {
        $data = $request->all();
        if ($this->promotionService->store($data)) {
            return redirect()->route('admin.promotions.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.promotions.create')->with('error', trans('common.message.create_error'));
    }
}
