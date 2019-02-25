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
     * @param int   $id      parent category
     * @param array $columns columns
     *
     * @return \Illuminate\Http\Response
     */
    public function getChildren(int $id, array $columns = ['*'])
    {
        $children = Category::where('parent_id', $id)->get($columns);
        return $children;
    }

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
     * @param array $columns columns
     *
     * @return \Illuminate\Http\Response
     */
    public function getParentList(array $columns = ['*'])
    {
        $categories = Category::whereNull('parent_id')->get($columns);
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
        if (count($category->children)) {
            if ($input['parent_id']) {
                session()->flash('error', trans('category.message.level_error'));
                return false;
            }
        } else {
            if ($input['parent_id']) {
                if (($this->isChild($input['parent_id'])) || ($input['parent_id'] == $category->id)) {
                    session()->flash('error', trans('category.request.level_error'));
                    return false;
                }
            }
        }
        return $category->update($input);
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
        return (isset($category->parent_id));
    }
}
