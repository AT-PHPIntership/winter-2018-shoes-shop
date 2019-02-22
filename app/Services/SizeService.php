<?php

namespace App\Services;

use App\Models\Size;

class SizeService
{
    /**
     * Get data form table size
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
