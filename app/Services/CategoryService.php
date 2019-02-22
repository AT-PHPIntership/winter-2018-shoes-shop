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
     * @return \Illuminate\Http\Response
     */
    public function getParentList()
    {
        $categories = Category::with(['children', 'products:id,category_id'])->select('id', 'name', 'parent_id')
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
     * Get childCategory by parentCategory
     *
     * @param string $parentCatName parentCatName
     * @param array  $columns       columns
     *
     * @return \Illuminate\Http\Response
     */
    public function getChildCatByParentCat(string $parentCatName, array $columns = ['*'])
    {
        $parentCat = Category::where('name', $parentCatName)->first(['id']);
        return Category::with(['children'])
        ->where('parent_id', $parentCat->id)
        ->get($columns);
    }

     /**
     * Get Category by id
     *
     * @param int $id id
     *
     * @return Category
     */
    public function getCategoryById(int $id)
    {
        return Category::findOrFail($id);
    }
}
