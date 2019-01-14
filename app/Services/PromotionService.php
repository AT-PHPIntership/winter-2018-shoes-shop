<?php

namespace App\Services;

use App\Models\Promotion;

class PromotionService
{
    /**
     * Get all data table promotions
     *
     * @return object
     */
    public function getPromotionWithPaginate()
    {
        return Promotion::orderBy('id', config('define.orderBy.desc'))->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Promotion $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        try {
            return $promotion->delete();
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
