<?php

namespace App\Services;

use App\Models\Promotion;
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
        return Promotion::orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Get promotion by id
     *
     * @param int $id id
     *
     * @return object
     */
    public function getPromotionById($id)
    {
        return Promotion::with([
        'products' => function ($query) {
            $query->select('products.id as product_id', 'name', 'category_id');
        },'products.category' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($id);
    }

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
                $promotion->products()->attach($data['product_id']);
            }
            DB::commit();
            return $promotion;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
}
