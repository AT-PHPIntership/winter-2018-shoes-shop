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
    public function getAll(array $columns = ['*'], array $conditions = ['1' ,'1'])
    {
        return Category::select($columns)->where($conditions)->get();
    }
}
