<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Category;

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
        $id = Category::where('name', $categoryName)->first()->id;
        if (Category::where('parent_id', $id)->get()->count()) {
            $categoryIds = Category::where('parent_id', $id)->get(['id']);
        } else {
            $categoryIds = Category::where('id', $id)->get(['id']);
        }
        return Product::with(['category:id,name', 'images:id,path,product_id', 'promotions'])
        ->whereIn('category_id', $categoryIds)
        ->limit(8)
        ->get($columns);
    }

    /**
     * Get new products
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewProducts(array $columns = ['*'])
    {
        return Product::with(['images:id,path,product_id', 'promotions'])
        ->orderBy('id', 'desc')
        ->limit(8)
        ->get($columns);
    }

    /**
     * Get top sell products
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopSellProducts(array $columns = ['*'])
    {
        $productIds = OrderDetail::select(\DB::raw('count(product_id) as total, product_id'))->groupBy('product_id')->orderBy('total', 'desc')->limit(8)->get()->pluck('product_id');
        return Product::with(['images:id,path,product_id', 'promotions'])
        ->whereIn('id', $productIds)
        ->get($columns);
    }
}
