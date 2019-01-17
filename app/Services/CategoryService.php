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
     * Handle get parents list from database
     *
     * @return \Illuminate\Http\Response
     */
    public function getParentList()
    {
        $categories = Category::select('id', 'name', 'parent_id')
                        ->whereNull('parent_id')
                        ->get();
        return $categories;
    }

    /**
     * Handle store categoriy from view
     *
     * @param array $input data from request
     *
     * @return boolean
     */
    public function storeCategory(array $input)
    {
        return Category::create($input);
    }

    /**
     * Handle get categoriy by id
     *
     * @param int $id of category
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Handle update category from view
     *
     * @param array    $input    data from request
     * @param Category $category of category
     *
     * @return array
     */
    public function updateCategory(array $input, $category)
    {
        // $category = $this->getCategoryById($id);
        if (count($category->children)) {
            if ($category->parent_id != $input->parent_id) {
                return ('children_error');
            }
        }
        return $category->update($input);
        if ($category->update($input)) {
            return true;
        }
    }
}
