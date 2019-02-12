<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Category;
use App\Models\Size;
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
     * Get product by id
     *
     * @param int $id id id
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductById(int $id)
    {
        $product = Product::with(['category:id,name', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }, 'images:id,product_id,path', 'productDetails:id,product_id,color_id', 'productDetails.color:id,name'])->findOrFail($id);
        $data['product'] = [
            'id' => $product->id,
            'name' => $product->name,
            'original_price' => $product->original_price,
            'price' => $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : null,
            'inventory' => $product->quantity - $product->total_sold,
            'description' => $product->description,
        ];
        $data['category'] = [
            'id' => $product->category->id,
            'name' => $product->category->name,
        ];
        $data['images'] = $product->images;
        $details = $product->productDetails->map(function ($item) {
            return [
                'colors' => $item['color'],
            ];
        });
        $data['colors'] = $details->pluck('colors');
        return json_encode($data);
    }

    /**
     * Get sizes by colorId
     *
     * @param int $colorId colorId colorId
     *
     * @return \Illuminate\Http\Response
     */
    public function getSizesByColorId(int $colorId)
    {
        return Size::join('product_details', 'sizes.id', '=', 'product_details.size_id')
            ->where('product_details.color_id', $colorId)->orderBy('size_id')->get(['size_id', 'size', 'quantity']);
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
