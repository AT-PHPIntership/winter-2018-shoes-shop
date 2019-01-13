<?php

namespace App\Services;

use App\Models\Product;

class ProductService
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
        return Product::select($columns)->get();
    }
}
