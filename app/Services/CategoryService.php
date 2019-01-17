<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryService
{
    /**
     * Handle get children list of category
     *
     * @return \Illuminate\Http\Response
     */
    public function getChildren()
    {
        $children = Category::whereNotNull('parent_id')
                    ->get();
        return $children;
    }

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
