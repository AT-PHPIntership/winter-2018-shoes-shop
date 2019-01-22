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
}
