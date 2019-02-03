<?php

namespace App\Services;

use App\Models\Size;

class SizeService
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
        return Size::get($columns);
    }
}
