<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Category;
use Carbon\Carbon;

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
     * @return Product
     */
    public function getProductsByCat(string $categoryName, array $columns = ['*'])
    {
        $id = Category::where('name', $categoryName)->first(['id'])->id;
        if (Category::where('parent_id', $id)->count()) {
            $categoryIds = Category::where('parent_id', $id)->get(['id']);
        } else {
            $categoryIds = Category::where('id', $id)->get(['id']);
        }
        return Product::with(['category:id,name', 'images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])
        ->whereIn('category_id', $categoryIds)
        ->orderBy('updated_at', 'desc')
        ->get($columns);
    }

    /**
     * Get new products
     *
     * @param array $columns columns
     *
     * @return Product
     */
    public function getNewProducts(array $columns = ['*'])
    {
        return Product::with(['images:id,path,product_id', 'promotions'])
        ->orderBy('updated_at', 'desc')
        ->limit(config('define.limit_rows_product'))
        ->get($columns);
    }

    /**
     * Get top sell products
     *
     * @param array $columns columns
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopSellProducts(array $columns = ['*'])
    {
        $productIds = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(\DB::raw('count(product_id) as total, product_id'))
            ->where('orders.status', Order::ORDER_STATUS['DELIVERED'])
            ->groupBy('product_id')->orderBy('total', 'desc')
            ->limit(config('define.limit_rows_product'))
            ->pluck('product_id');
        return Product::with(['images:id,path,product_id', 'promotions'])
        ->whereIn('id', $productIds)
        ->limit(config('define.limit_rows_product'))
        ->get($columns);
    }
}
