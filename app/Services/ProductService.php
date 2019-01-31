<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
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
        $product = Product::with(['category:id,name', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }, 'images:id,product_id,path', 'productDetails:id,product_id,color_id,size_id', 'productDetails.color:id,name', 'productDetails.size:id,size'])->findOrFail($id);
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
       
        // $colors = $product->productDetails->map(function ($item) {
        //     return $item['color'];
        // });
        // $sizes = $product->productDetails->map(function ($item) {
        //     return $item['size'];
        // });
        // $data['colors'] = $colors->keyBy('id');
        // $data['sizes'] = $sizes->keyBy('id');
        $details = $product->productDetails->map(function ($item) {
            return [
                'colors' => $item['color'],
                'sizes' => $item['size'],
            ];
        });
        $data['colors'] = $details->pluck('colors')->keyBy('id');
        $data['sizes'] = $details->pluck('sizes')->keyBy('id');
        // \Log::debug($data['colors']);
        return json_encode($data);
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
