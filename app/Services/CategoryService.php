<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryService
{
    /**
    * Handle get categories list to data
    *
    * @return void
    */
    public function getList()
    {
        $categories = Category::select('id', 'name', 'parent_id')
                    ->paginate(config('define.number_element_in_table'));
        return $categories;
    }
}
