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
        if (Category::where('parent_id', $id)->get()->count()) {
            $ids = Category::where('parent_id', $id)->get(['id'])->pluck('id')->toArray();
        } else {
            $ids = Category::where('id', $id)->get(['id'])->pluck('id')->toArray();
        }
        return Product::with(['category:id,name', 'images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])
        ->whereIn('category_id', $ids)
        // ->paginate(config('define.paginate.limit_rows_12'));
        ->get();
    }

    /**
     * Get products by colorId and categoryId
     *
     * @param int $colorId    colorId
     * @param int $categoryId categoryId
     *
     * @return \Illuminate\Http\Response
     */
    public function filterProduct(array $data)
    {
        $products =  Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now());
        }])
        ->join('categories as c', 'c.id', '=', 'products.category_id')
        ->join('product_details as pd', 'pd.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'products.original_price')
        ->where('category_id', $data['categoryId']);
        if (isset($data['colorIds'])) {
            $products->whereIn('color_id', $data['colorIds']);
        }
        if (isset($data['sizeIds'])) {
            $products->whereIn('size_id', $data['sizeIds']);
        }
        if (isset($data['minPrice'], $data['maxPrice'])) {
            $products->whereBetween('original_price', [$data['minPrice'], $data['maxPrice']]);
        }
        if (!empty($data['sort'])) {
            $sort = explode('-', $data['sort']);
            if ($sort[0] == 'name') {
                $products->orderBy('name', $sort[1]);
            } elseif ($sort[0] == 'price') {
                $products->orderBy('original_price', $sort[1]);
            } elseif ($sort[0] == 'update_at') {
                $products->orderBy('updated_at', $sort[1]);
            }
        }
        $products = $products->distinct('product_id')->get();
        $result = [];
        foreach ($products as $key => $product) {
            $result[$key]['name'] = $product->name;
            $result[$key]['original_price'] = $product->original_price;
            $result[$key]['price'] =  $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : null;
            $result[$key]['image'] =  $product->images->first() ? $product->images->first()->path : config('define.image_default_product');
        }
        return $result;
        $a = $data['sort'];
        $a = explode('-', $a);
        return $a[0];
    }
}
