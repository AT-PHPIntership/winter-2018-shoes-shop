<?php

namespace App\Services;

use App\Models\Promotion;
use DB;
use Log;

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
     * @return Promotion
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
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return false;
        }
    }

    /**
     * Get promotion with products
     *
     * @param int $id id
     *
     * @return object
     */
    public function getPromotionWithProducts($id)
    {
        return Promotion::with([
        'products' => function ($query) {
            $query->select('products.id as product_id', 'name');
        }])->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array     $data      data
     * @param Promotion $promotion promotion
     *
     * @return Promotion
     */
    public function update(array $data, Promotion $promotion)
    {
        DB::beginTransaction();
        try {
            $promotion->update($data);
            if (isset($data['product_id'])) {
                $promotion->products()->sync($data['product_id']);
            }
            DB::commit();
            return $promotion;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return false;
        }
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
        try {
            return $promotion->delete();
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
