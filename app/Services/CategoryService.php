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
        $categories = Category::where('delete_flag', 0)
                    ->orderBy('updated_at', 'desc')
                    ->paginate(config('paging.number_element_in_page'));
        return $categories;
    }

    /**
     * Handle get parent category to data
     *
     * @return \Illuminate\Http\Response
     */
    public function getParent()
    {
        $parents = Category::where('delete_flag', 0)
                    ->whereNull('parent_id')
                    ->get();
        return $parents;
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

    /**
     * Handle get categoriy by id
     *
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryById($id)
    {
        return Category::where('delete_flag', 0)->findOrFail($id);
    }

    /**
     * Handle update category from view
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     * @param int                      $id      comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, $id)
    {
        $category = $this->getCategoryById($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        if ($category->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Handle delete category from view
     *
     * @param int $id of category
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        foreach($category->children as $child) {
            $child->delete_flag = 1;
        }
        $category->delete_flag = 1;
        
        if ($category->save()) {
            return true;
        } else {
            return false;
        }
    }
}
