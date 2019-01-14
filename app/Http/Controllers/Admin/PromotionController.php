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
     * Remove the specified resource from storage.
     *
     * @param App\Models\Code $code code
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
