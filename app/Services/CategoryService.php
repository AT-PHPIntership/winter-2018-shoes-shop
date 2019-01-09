<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get all data table role
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getSubCategory(array $columns = ['*'])
    {
        return Category::select($columns)->get();
    }
}
