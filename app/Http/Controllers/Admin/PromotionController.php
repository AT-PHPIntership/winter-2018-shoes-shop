<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\PromotionService;
use App\Models\Promotion;
use App\Http\Requests\Admin\PutPromotionRequest;

class PromotionController extends Controller
{
    private $promotionService;

    /**
    * Contructer
    *
    * @param App\Service\PromotionService $promotionService promotionService
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
        $promotions = $this->promotionService->getPromotionWithPaginate();
        return view('admin.promotion.list', compact('promotions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Promotion $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request   request
     * @param App\Models\promotion     $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutPromotionRequest $request, Promotion $promotion)
    {
        $data = $request->all();
        if (!empty($this->promotionService->update($data, $promotion))) {
            return redirect()->route('admin.promotions.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.promotions.edit', $promotion)->with('error', trans('common.message.edit_error'));
    }
}
