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
    public function getSizes(array $columns = ['*'])
    {
        return Size::get($columns);
    }

    /**
     * Get data from sizes depend on product
     *
     * @param int $id product
     *
     * @return object
     */
    public function getSizesByProduct(int $id)
    {
        $allsizes = $this->getSizes(['id', 'size']);
        return $allsizes;
    }
}
