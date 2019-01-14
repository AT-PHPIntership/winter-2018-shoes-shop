<?php

namespace App\Services;

use App\Models\Size;

class SizeService
{
    /**
     * Get data form table size
     *
     * @return object
     */
    public function getSizes()
    {
        return Size::select('id', 'size')->get();
    }
}
