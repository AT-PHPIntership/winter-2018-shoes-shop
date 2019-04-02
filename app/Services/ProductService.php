<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Category;
use App\Models\Size;
use Carbon\Carbon;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Color;
use DB;
use Log;
use Session;
use Illuminate\Http\UploadedFile;
use File;

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
            'images:imageable_type,imageable_id,path',
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
        }, 'images:id,imageable_type,imageable_id,path', 'productDetails:id,product_id,color_id', 'productDetails.color:id,name'])->findOrFail($id);
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
     * Get sizes by colorId and productId
     *
     * @param int $colorId   colorId
     * @param int $productId productId
     *
     * @return \Illuminate\Http\Response
     */
    public function getSizesByColorId(int $colorId, int $productId)
    {
        return Size::join('product_details', 'sizes.id', '=', 'product_details.size_id')
            ->where('product_details.color_id', $colorId)
            ->where('product_details.product_id', $productId)
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
        $product = Product::with(['category:id,name', 'images:id,path,imageable_type,imageable_id', 'promotions' => function ($query) {
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
        return Product::with(['images:id,path,imageable_type,imageable_id', 'promotions' => function ($query) {
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
        return Product::with(['images:id,path,imageable_type,imageable_id', 'promotions' => function ($query) {
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
        $products =  Product::with(['images:id,path,imageable_type,imageable_id', 'promotions' => function ($query) {
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
        $products = $this->subFilter($products, $data);
        $products = $products->groupBy('products.id')->paginate(config('define.paginate.limit_rows_12'));
        $result = [];
        $items = [];
        foreach ($products as $key => $product) {
            $items[$key]['id'] = $product->id;
            $items[$key]['name'] = $product->name;
            $items[$key]['original_price'] = $product->original_price;
            $items[$key]['price'] =  $product->promotions->last() ? ($product->original_price * (100 - $product->promotions->last()->percent))/100 : null;
            $items[$key]['image'] =  $product->images->first() ? $product->images->first()->path : config('define.image_default_product');
        }
        $result['products'] = $items;
        $result['page'] = $products->lastPage();
        return $result;
    }

    /**
     * Filter products
     *
     * @param object $products products
     * @param array  $data     data
     *
     * @return object
     */
    public function subFilter(object $products, array $data)
    {
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
            $sortBy = $sort[0];
            $sortVal = $sort[1];
            if ($sortBy == 'name') {
                $products->orderBy('name', $sortVal);
            } elseif ($sortBy == 'price') {
                $products->orderBy('original_price', $sortVal);
            } elseif ($sortBy == 'update_at') {
                $products->orderBy('updated_at', $sortVal);
            }
        }
        return $products;
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
        return Product::with(['images:id,path,imageable_type,imageable_id', 'promotions' => function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                  ->where('end_date', '>=', Carbon::now());
        }])->where('name', 'like', '%'.$search.'%')
        ->orderBy('updated_at', 'desc')
        ->paginate(config('define.paginate.limit_rows_12'), ['name', 'id', 'original_price'])
        ->appends(['s' => $search]);
    }

    /**
     * Get specified product by id
     *
     * @param array $data product
     *
     * @return \Illuminate\Http\Response
     */
    public function handleStoreProduct($data)
    {
        DB::beginTransaction();
        try {
            $quantity = 0;
            foreach ($data['quantity_type'] as $itemQuantity) {
                $quantity = $quantity + $itemQuantity;
            }
            $categoryId = isset($data['child_category_id']) ? $data['child_category_id'] : $data['parent_category_id'];
            $dataProductDetails = $this->checkDuplicate($data['color_id'], $data['size_id'], $data['quantity_type']);
            $newProduct = $this->createProduct($data['name'], $categoryId, $data['original_price'], $quantity, $data['description']);
            foreach ($dataProductDetails as $detail) {
                $this->createProductDetail($newProduct->id, $detail['color'], $detail['size'], $detail['quantity']);
            }
            if (isset($data['upload_file'])) {
                $this->createImages($data, $newProduct->id);
            }
            DB::commit();
            return $newProduct;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
    /**
     * Upload Image
     *
     * @param array $image files
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage($image)
    {
        $fileName = time().'-'.$image->getClientOriginalName();
        $image->move('upload', $fileName);
        return $fileName;
    }

    /**
     * Store image files
     *
     * @param array $data      image data
     * @param int   $productId product id
     *
     * @return \Illuminate\Http\Response
     */
    public function createImages($data, $productId)
    {
        foreach ($data['upload_file'] as $image) {
            if ($image->isValid()) {
                $extensions = ['jpg' , 'jpeg' ,'png', 'gif'];
                if (in_array($image->extension(), $extensions)) {
                    try {
                        Image::create([
                            'imageable_type' => 'products',
                            'imageable_id' => $productId,
                            'path' => $this->uploadImage($image)
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                } else {
                    Session::flash('error', trans('product.image_error'));
                }
            } else {
                Session::flash('error', trans('product.image_error'));
            }
        }
    }

    /**
     * Store product detail of each product
     *
     * @param int $productId productId
     * @param int $colorId   colorId
     * @param int $sizeId    sizeId
     * @param int $quantity  quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function createProductDetail($productId, $colorId, $sizeId, $quantity)
    {
        ProductDetail::create([
            'product_id' => $productId,
            'color_id' => $colorId,
            'size_id' => $sizeId,
            'quantity' => $quantity,
        ]);
    }

    /**
     * Store product
     *
     * @param string $name          product  name
     * @param int    $categoryId    category id
     * @param int    $originalPrice original price
     * @param int    $quantity      quantity
     * @param string $description   description
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct($name, $categoryId, $originalPrice, $quantity, $description)
    {
        return Product::create([
            'name' => $name,
            'category_id' => $categoryId,
            'original_price' => $originalPrice,
            'quantity' => $quantity,
            'description' => $description,
        ]);
    }

    /**
     * Filter data of product detail
     *
     * @param array $colors     colorId
     * @param array $sizes      sizeId
     * @param array $quantities quantity
     *
     * @return array
     */
    public function checkDuplicate($colors, $sizes, $quantities)
    {
        $output = [];
        for ($i = 0; $i < count($colors); $i++) { //check each data of input
            for ($j = 0; $j < count($output); $j++) { //compare each data in output
                if (($colors[$i] == $output[$j]['color']) && ($sizes[$i] == $output[$j]['size'])) {
                    $output[$j]['quantity'] += $quantities[$i];
                    break;
                }
            }
            if ($j == count($output)) { //add data to output if not exist
                $detail['color'] = $colors[$i];
                $detail['size'] = $sizes[$i];
                $detail['quantity'] = $quantities[$i];
                array_push($output, $detail);
            }
        }
        return $output;
    }

    /**
     * Handle process import file csv including products data.
     *
     * @param \Illuminate\Http\Request $data data
     *
     * @return \Illuminate\Http\Response
     */
    public function handleImportData($data)
    {
        if (!$this->previousCheck($data)) {
            return false;
        }
        DB::beginTransaction();
        foreach ($data as $key => $value) {
            $categoryId = $this->getCategoryByName($value->category);
            $sizeId = $this->getSizeByName($value->size);
            $colorId = $this->getColorByName($value->color);
            $checkName = $this->checkNameExist($value->name);
            if ($checkName) {
                $product = $this->checkInfoCorrect($value->name, $categoryId, $value->original_price, $value->description);
                if (!$product) {
                    session()->flash('error', trans('common.message.file_error', ['line' => $key + 2]));
                    return false;
                }
                if ($product) {
                        $product->quantity += $value->quantity;
                        $product->save(); //update quantity of product
                    try {
                        $productDetail = $this->checkDetailExist($product->id, $colorId, $sizeId);
                        if ($productDetail) {
                            $productDetail->quantity += $value->quantity;
                            $productDetail->save(); //update quantity of product detail
                        } else {
                            $this->createProductDetail($product->id, $colorId, $sizeId, $value->quantity);
                        }
                    } catch (Exception $e) {
                        Log::error($e);
                        DB::rollback();
                    }
                }
            } else {
                try {
                    $newProduct = $this->createProduct($value->name, $categoryId, $value->original_price, $value->quantity, $value->description);
                    $this->createProductDetail($newProduct->id, $colorId, $sizeId, $value->quantity);
                } catch (Exception $e) {
                    Log::error($e);
                    DB::rollback();
                }
            }
        }
        DB::commit();
        return true;
    }

    /**
     * Check previously if category, zise, color exist
     *
     * @param \Illuminate\Http\Request $data data
     *
     * @return boolean
     */
    public function previousCheck($data)
    {
        foreach ($data as $key => $value) {
            $categoryId = $this->getCategoryByName($value->category);
            $sizeId = $this->getSizeByName($value->size);
            $colorId = $this->getColorByName($value->color);
            if ((!$categoryId) || (!$sizeId) || (!$colorId)) {
                session()->flash('error', trans('common.message.file_error', ['line' => $key + 2]));
                return false;
            }
        }
        return true;
    }

    /**
     * Check if product name alredy exist
     *
     * @param string $name name
     *
     * @return boolean
     */
    public function checkNameExist($name)
    {
        $product = Product::where('name', $name)->get();
        return (count($product) > 0);
    }

    /**
     * Check if product information are correct
     *
     * @param string $name        name
     * @param int    $categoryId  categoryId
     * @param string $price       price
     * @param string $description description
     *
     * @return boolean
     */
    public function checkInfoCorrect($name, $categoryId, $price, $description)
    {
        $product = Product::where('name', $name)
                    ->where('category_id', $categoryId)
                    ->where('original_price', $price)
                    ->where('description', $description)
                    ->first();
        return $product;
    }

    /**
     * Check if product detail is exist
     *
     * @param int $productId productId
     * @param int $colorId   colorId
     * @param int $sizeId    sizeId
     *
     * @return boolean
     */
    public function checkDetailExist($productId, $colorId, $sizeId)
    {
        $productDetail = ProductDetail::where('product_id', $productId)
                    ->where('color_id', $colorId)
                    ->where('size_id', $sizeId)
                    ->first();
        return $productDetail;
    }

    /**
     * Get id of category
     *
     * @param string $name category name
     *
     * @return int
     */
    public function getCategoryByName($name)
    {
        $category = Category::select('id')->where('name', $name)->first();
        if ($category) {
            return $category->id;
        }
        return false;
    }

    /**
     * Get id of size
     *
     * @param string $name size
     *
     * @return int
     */
    public function getSizeByName($name)
    {
        $size = Size::select('id')->where('size', $name)->first();
        if ($size) {
            return $size->id;
        }
        return false;
    }

    /**
     * Get id of color
     *
     * @param string $name color name
     *
     * @return int
     */
    public function getColorByName($name)
    {
        $color = Color::select('id')->where('name', $name)->first();
        if ($color) {
            return $color->id;
        }
        return false;
    }

    /**
     * Update specified product
     *
     * @param array              $data    product
     * @param App\Models\Product $product product
     *
     * @return \Illuminate\Http\Response
     */
    public function handleUpdateProduct(array $data, Product $product)
    {
        $quantity = 0;
        foreach ($data['quantity_type'] as $itemQuantity) {
            $quantity = $quantity + $itemQuantity;
        }
        $categoryId = isset($data['child_category_id']) ? $data['child_category_id'] : $data['parent_category_id'];
        $dataProductDetails = $this->checkDuplicate($data['color_id'], $data['size_id'], $data['quantity_type']);
        DB::beginTransaction();
        try {
            $this->updateProduct($product->id, $data['name'], $categoryId, $data['original_price'], $quantity, $data['description']);
            DB::table('product_details')->where('product_id', $product->id)->delete();
            foreach ($dataProductDetails as $detail) {
                $this->createProductDetail($product->id, $detail['color'], $detail['size'], $detail['quantity']);
            }
            if (isset($data['upload_file'])) {
                if (!$product->images->isEmpty()) {
                    foreach ($product->images as $image) {
                        File::delete(public_path($image->path));
                    }
                }
                DB::table('images')->where('imageable_type', 'products')->where('imageable_id', $product->id)->delete();
                $this->createImages($data, $product->id);
            }
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }

    /**
     * Update product
     *
     * @param int    $id            product id
     * @param string $name          product  name
     * @param int    $categoryId    category id
     * @param int    $originalPrice original price
     * @param int    $quantity      quantity
     * @param string $description   description
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProduct($id, $name, $categoryId, $originalPrice, $quantity, $description)
    {
        Product::where('id', $id)->update([
            'name' => $name,
            'category_id' => $categoryId,
            'original_price' => $originalPrice,
            'quantity' => $quantity,
            'description' => $description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Product $product product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        try {
            if (!$product->images->isEmpty()) {
                foreach ($product->images as $image) {
                    File::delete(public_path($image->path));
                }
            }
            return $product->delete();
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }

    /**
     * Check quantity products in order
     *
     * @param array $products products
     *
     * @return array
     */
    public function checkQuantityProducts($products)
    {
        try {
            $error = [];
            foreach ($products as $key => $product) {
                $productDetail = ProductDetail::join('products', 'product_details.product_id', '=', 'products.id')
                    ->join('colors', 'colors.id', '=', 'product_details.color_id')
                    ->join('sizes', 'sizes.id', '=', 'product_details.size_id')
                    ->where('product_id', $product['product']['id'])
                    ->where('color_id', $product['color']['id'])
                    ->where('size_id', $product['size']['id'])
                    ->select('products.name as name', 'product_details.quantity', 'product_details.total_sold', 'colors.name as color', 'sizes.size as size')
                    ->first();
                $inventory = $productDetail->quantity - $productDetail->total_sold;
                if ($inventory < $product['product']['quantity']) {
                    $error[$key]['product'] = $productDetail->name;
                    $error[$key]['color'] = $productDetail->color;
                    $error[$key]['size'] = $productDetail->size;
                    $error[$key]['inventory'] = $inventory;
                }
            }
            return $error;
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Check exist products in order
     *
     * @param array $products products
     *
     * @return array
     */
    public function checkExistProducts($products)
    {
        try {
            $error = [];
            foreach ($products as $key => $value) {
                $product = ProductDetail::join('products', 'product_details.product_id', '=', 'products.id')
                    ->join('colors', 'colors.id', '=', 'product_details.color_id')
                    ->join('sizes', 'sizes.id', '=', 'product_details.size_id')
                    ->where('product_id', $value['product']['id'])
                    ->where('color_id', $value['color']['id'])
                    ->where('size_id', $value['size']['id'])
                    ->select('products.name as name', 'product_details.quantity', 'product_details.total_sold', 'colors.name as color', 'sizes.size as size')
                    ->first();
                if (!$product) {
                    $error[$key]['id'] = $value['product']['id'];
                }
            }
            return $error;
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Export csv file including product data
     *
     * @return \Illuminate\Http\Response
     */
    public function handleExportProductData()
    {
        $data = $this->getAll(['category_id', 'name', 'original_price', 'quantity', 'total_sold']);
        return \Excel::create('product_data', function ($excel) use ($data) {
            $excel->sheet('sheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue(trans('common.table.num'));
                });
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue(trans('product.name'));
                });
                $sheet->cell('C1', function ($cell) {
                    $cell->setValue(trans('product.category'));
                });
                $sheet->cell('D1', function ($cell) {
                    $cell->setValue(trans('product.price'));
                });
                $sheet->cell('E1', function ($cell) {
                    $cell->setValue(trans('product.quantity'));
                });
                $sheet->cell('F1', function ($cell) {
                    $cell->setValue(trans('product.total_sold'));
                });
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A'.$i, $key + 1);
                        $sheet->cell('B'.$i, $value->name);
                        $sheet->cell('C'.$i, $value->category->name);
                        $sheet->cell('D'.$i, $value->original_price);
                        $sheet->cell('E'.$i, $value->quantity);
                        $sheet->cell('F'.$i, $value->total_sold);
                    }
                }
            });
        })->download('csv');
    }
}
