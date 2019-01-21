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
}