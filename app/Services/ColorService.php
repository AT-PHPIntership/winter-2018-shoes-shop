<?php

namespace App\Services;

use App\Models\Color;

class ColorService
{
    /**
     * Get data from colors table
     *
     * @return object
     */
    public function getColors()
    {
        return Color::select('id', 'name')->get();
    }
}
