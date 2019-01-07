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
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $categories = Category::select('id', 'name', 'parent_id')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(config('define.number_element_in_table'));
        return $categories;
    }

    /**
     * Handle store categoriy from view
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        if ($category->save()) {
            return true;
        } else {
            return false;
        }
    }
}
