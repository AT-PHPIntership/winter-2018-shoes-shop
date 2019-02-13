<?php

namespace App\Services;

use App\Models\Product;
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
     * Get specified product by id
     *
     * @param int $id product
     *
     * @return \Illuminate\Http\Response
     */
    // public function getProductById($id)
    // {
    //     $product = Product::with([
    //         'images:product_id,path',
    //         'category:id,name',
    //         'productDetails' => function ($query) {
    //             $query->with(['size:id,size', 'color:id,name']);
    //         }
    //     ])->findOrFail($id);
    //     return $product;
    // }

    /**
     * Get product by id
     *
     * @param int $id id product
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
            'price' => $product->promotions->last() ? ($product->original_price * (100 - $product->promotions->last()->percent))/100 : null,
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
        $data['colors'] = $details->pluck('colors')->keyBy('id');
        return $data;
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
}
