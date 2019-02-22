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
     * Get specified product by id
     *
     * @param int $id product
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id)
    {
        $product = Product::with([
            'images:product_id,path',
            'category:id,name',
            'productDetails' => function ($query) {
                $query->with(['size:id,size', 'color:id,name']);
            }
        ])->findOrFail($id);
        return $product;
    }

    /**
     * Get detail product
     *
     * @param int $id id id
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailProduct(int $id)
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
            ->where('product_details.color_id', $colorId)
            ->orderBy('sizes.id')->get(['sizes.id', 'size', \DB::raw('`quantity` - `total_sold` as inventory')])
            ->keyBy('id');
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
        $product = Product::with(['category:id,name', 'images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }]);
        if (Category::where('parent_id', $id)->count()) {
            $ids = Category::where('parent_id', $id)->get(['id']);
            $product = $product->whereIn('category_id', $ids);
        } else {
            $product = $product->where('category_id', $id);
        }
        return $product->orderBy('updated_at', 'desc')->get($columns);
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
        return Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])->orderBy('updated_at', 'desc')
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
        return Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])->whereIn('id', $productIds)
        ->limit(config('define.limit_rows_product'))
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
     * Filter products
     *
     * @param array $data data
     *
     * @return array
     */
    public function filterProduct(array $data)
    {
        $products =  Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now());
        }])
        ->join('categories as c', 'c.id', '=', 'products.category_id')
        ->join('product_details as pd', 'pd.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'products.original_price');
        if (Category::where('parent_id', $data['categoryId'])->count()) {
            $ids = Category::where('parent_id', $data['categoryId'])->orWhere('id', $data['categoryId'])->pluck('id')->toArray();
        } else {
            $ids = Category::where('id', $data['categoryId'])->pluck('id')->toArray();
        }
        $products->whereIn('category_id', $ids);
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
            $result[$key]['id'] = $product->id;
            $result[$key]['name'] = $product->name;
            $result[$key]['original_price'] = $product->original_price;
            $result[$key]['price'] =  $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : null;
            $result[$key]['image'] =  $product->images->first() ? $product->images->first()->path : config('define.image_default_product');
        }
        return $result;
    }

    /**
     * Get list product
     *
     * @param string $search search
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(string $search)
    {
        return Product::with(['images:id,path,product_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])->where('name', 'like', '%'.$search.'%')
        ->orderBy('updated_at', 'desc')
        ->paginate(config('define.paginate.limit_rows_12'), ['name', 'id', 'original_price'])
        ->appends(['s' => $search]);
    }
}
