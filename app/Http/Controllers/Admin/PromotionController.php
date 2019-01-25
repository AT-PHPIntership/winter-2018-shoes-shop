<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\PromotionService;
use App\Models\Promotion;
use App\Http\Requests\Admin\PutPromotionRequest;
use App\Http\Requests\Admin\PostPromotionRequest;

class PromotionController extends Controller
{
    protected $promotionService;

    /**
    * Contructer
    *
    * @param PromotionService $promotionService promotionService
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
     * Display the specified resource.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = $this->promotionService->getPromotionById($id);
        return view('admin.promotion.show', compact('promotion'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $promotion = $this->promotionService->getPromotionWithProducts($id);
        return view('admin.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutPromotionRequest $request   request
     * @param Promotion           $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutPromotionRequest $request, Promotion $promotion)
    {
        $data = $request->all();
        if ($this->promotionService->update($data, $promotion)) {
            return redirect()->route('admin.promotions.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.promotions.edit', ['id' => $promotion->id])->with('error', trans('common.message.edit_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Promotion $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if ($this->promotionService->destroy($promotion)) {
            return redirect()->route('admin.promotions.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.promotions.index')->with('error', trans('common.message.delete_error'));
    }
}
