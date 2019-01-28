<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Get all data table products
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getAll(array $columns = ['*'])
    {
        return Product::get($columns);
    }
    
    /**
     * Get products list form database
     *
     * @return \Illuminate\Http\Response
     */
    public function getListWithPaginate()
    {
        $products = Product::orderBy('updated_at', 'desc')
                    ->paginate(config('define.number_element_in_table'));
        return $products;
    }

    /**
     * Get categoriy by id
     *
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Get products by category
     *
     * @param string $categoryName categoryName
     * @param array  $columns      columns
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductByCategory(string $categoryName, array $columns = ['*'])
    {
        return Product::with(['category' => function($query) use ($categoryName) {
            $query->select('id', 'name')->where('name', $categoryName);
        }, 'images:id,path,product_id', 'promotions'])
        ->limit(4)
        ->get($columns);
    }
}
