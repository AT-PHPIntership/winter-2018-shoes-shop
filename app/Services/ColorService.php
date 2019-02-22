<?php

namespace App\Services;

use App\Models\Color;

class ColorService
{
    /**
     * Get data from colors table
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getAll(array $columns = ['*'])
    {
        return Color::get($columns);
    }
}
