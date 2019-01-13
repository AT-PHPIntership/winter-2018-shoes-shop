<?php

namespace App\Services;

use App\Models\Promotion;
use App\Models\ProductPromotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromotionService
{
    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return object
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $promotion = Promotion::create($data);
            if (isset($data['product_id'])) {
                foreach ($data['product_id'] as $idProduct) {
                    ProductPromotion::create([
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
