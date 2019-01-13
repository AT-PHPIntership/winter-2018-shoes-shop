<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\PromotionService;
use App\Models\Promotion;

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
     * Display the specified resource.
     *
     * @param App\Models\Promotion $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return view('admin.promotion.show', compact('promotion'));
    }
}
