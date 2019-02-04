<?php

namespace App\Services;

use App\Models\Color;
use App\Models\ProductDetail;

class ColorService
{
    /**
     * Get data from colors table
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getColors(array $columns = ['*'])
    {
        return Color::get($columns);
    }

    /**
     * Get data from colors depend on product
     *
     * @param int $id product
     *
     * @return object
     */
    public function getColorsByProduct(int $id)
    {
        $allColors = $this->getColors(['id', 'name']);
        $detail = ProductDetail::where('product_id', $id)->get();
        foreach ($detail as $key => $value) {
            dd($value->color);
        }
        return $allColors;
    }
}
