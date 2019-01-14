<?php

namespace App\Services;

use App\Models\Promotion;
use App\Models\ProductPromotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * Update the specified resource in storage.
     *
     * @param array                $data      data
     * @param App\Models\Promotion $promotion promotion
     *
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, Promotion $promotion)
    {
        DB::beginTransaction();
        try {
            $promotion->update($data);
            if (isset($data['product_id'])) {
                foreach ($data['product_id'] as $idProduct) {
                    $promotion->products->update([
                        'product_id' => $idProduct,
                        'promotion_id' => $promotion->id,
                    ]);
                }
            }
            DB::commit();
            return $promotion;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
}
