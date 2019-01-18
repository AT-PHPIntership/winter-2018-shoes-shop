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
        $categories = Category::select('id', 'name')
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
        if ($category->parent_id) {
            if ($input['parent_id']) {
                if (!($this->exists($input['parent_id']))) {
                    session()->flash('error', trans('category.request.category_exists'));
                    return false;
                } else {
                    if ($this->isChild($input['parent_id'])) {
                        session()->flash('error', trans('category.request.level_error'));
                        return false;
                    }
                }
            }
        } else {
            if ($input['parent_id']) {
                session()->flash('error', trans('category.message.level_error'));
                return false;
            }
        }
        return $category->update($input);
    }

    /**
     * Check if category exists
     *
     * @param int $id of category
     *
     * @return boolean
     */
    public function exists($id)
    {
        return Category::find($id);
    }

    /**
     * Check if category is children
     *
     * @param int $id of category
     *
     * @return boolean
     */
    public function isChild($id)
    {
        $category = Category::find($id);
        return ($category->parent_id);
    }
}
