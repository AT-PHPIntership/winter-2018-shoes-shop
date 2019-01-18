<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get all data table categories
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getAll(array $columns = ['*'])
    {
        return Category::get($columns);
    }
}
