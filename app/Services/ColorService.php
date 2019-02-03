<?php

namespace App\Services;

use App\Models\Color;

class ColorService
{
    /**
     * Get all data table products
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getAll(array $columns = ['*'])
    {
        return Color::with('productDetails:id,color_id,product_id')->get($columns);
    }
}
