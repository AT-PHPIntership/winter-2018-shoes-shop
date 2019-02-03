<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\ProductDetail;
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
        return Product::with(['category:id,name', 'images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])
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

    /**
     * Get all data table products
     *
     * @return object
     */
    public function getProductWithPaginate()
    {
        return Product::with('promotions')->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows_12'));
    }

    /**
     * Get products by categoryId
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductByCatIdWithPaginate(int $id)
    {
        return Product::with(['category:id,name', 'images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])
        ->where('category_id', $id)
        ->paginate(config('define.paginate.limit_rows_12'));
    }

    /**
     * Get products by colorId and categoryId
     *
     * @param int $colorId    colorId
     * @param int $categoryId categoryId
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsByColorIdAndCategoryId(int $colorId, int $categoryId)
    {
        $products =  Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now());
        }])
        ->join('categories as c', 'c.id', '=', 'products.category_id')
        ->join('product_details as pd', 'pd.product_id', '=', 'products.id')
        ->join('colors', 'colors.id', '=', 'pd.color_id')
        ->select('products.id', 'products.name', 'products.original_price')
        ->where('category_id', $categoryId)
        ->where('color_id', $colorId)
        ->distinct('product_id')
        ->get();
        $data = [];
        foreach ($products as $key => $product) {
            $data[$key]['name'] = $product->name;
            $data[$key]['original_price'] = $product->original_price;
            $data[$key]['price'] =  $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : null;
            $data[$key]['image'] =  $product->images->first() ? $product->images->first()->path : config('define.image_default_product');
        }
        return $data;
    }
}
