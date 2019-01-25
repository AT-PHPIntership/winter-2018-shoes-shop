<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
<<<<<<< HEAD
=======
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
>>>>>>> 3729bda598ad060da8d26e96ffdb57ec8dab7442
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
     * Get specified product by id
     *
     * @param array $data product
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProduct($data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['quantity_type'])) {
                $quantity = 0;
                foreach ($data['quantity_type'] as $itemQuantity) {
                    $quantity = $quantity + $itemQuantity;
                }
                $newProduct = Product::create([
                    'name' => $data['name'],
                    'category_id' => $data['category_id'],
                    'original_price' => $data['original_price'],
                    'quantity' => $quantity,
                    'description' => $data['description'],
                ]);
                for ($i=0; $i < count($data['color_id']); $i++) {
                    $productDetail = $this->checkDetailExist($newProduct->id, $data['color_id'][$i], $data['size_id'][$i]);
                    if ($productDetail) {
                        $productDetail->quantity += $data['quantity_type'][$i];
                        $productDetail->save();
                    } else {
                        ProductDetail::create([
                            'product_id' => $newProduct->id,
                            'color_id' => $data['color_id'][$i],
                            'size_id' => $data['size_id'][$i],
                            'quantity' => $data['quantity_type'][$i],
                        ]);
                    }
                }
            } else {
                $product->update([
                    'name' => $data['name'],
                    'category_id' => $data['category_id'],
                    'original_price' => $data['original_price'],
                    'quantity' => 0,
                    'description' => $data['description'],
                ]);
            }
            if (isset($data['upload_file'])) {
                foreach ($data['upload_file'] as $image) {
                    Image::create([
                        'product_id' => $newProduct->id,
                        'path' => $this->uploadImage($image)
                    ]);
                }
            }
            DB::commit();
            return $newProduct;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }

    /**
     * Upload Image
     *
     * @param string $image Image
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
<<<<<<< HEAD
     * Handle process import file csv including products data.
     *
     * @param \Illuminate\Http\Request $data of products
     *
     * @return \Illuminate\Http\Response
     */
    public function importData($data)
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
                        $product->save();
                    try {
                        $productDetail = $this->checkDetailExist($product->id, $colorId, $sizeId);
                        if ($productDetail) {
                            $productDetail->quantity += $value->quantity;
                            $productDetail->save();
                        } else {
                            ProductDetail::create([
                                'product_id' => $product->id,
                                'color_id' => $colorId,
                                'size_id' => $sizeId,
                                'quantity' => $value->quantity,
                            ]);
                        }
                    } catch (Exception $e) {
                        Log::error($e);
                        DB::rollback();
                    }
                }
            } else {
                try {
                    $product = Product::create([
                        'name' => $value->name,
                        'category_id' => $categoryId,
                        'original_price' => $value->original_price,
                        'quantity' => $value->quantity,
                        'description' => $value->description,
                    ]);
                    ProductDetail::create([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                        'quantity' => $value->quantity,
                    ]);
                } catch (Exception $e) {
                    Log::error($e);
                    DB::rollback();
                }
            }
        }
        return true;
    }

    /**
     * Check if product name alredy exist
     *
     * @param string $name product
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
     * @param string $name        product
     * @param int    $categoryId  product
     * @param string $price       product
     * @param string $description product
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
=======
>>>>>>> 3729bda598ad060da8d26e96ffdb57ec8dab7442
     * Check if product detail is exist
     *
     * @param int $productId product detail
     * @param int $colorId   product detail
     * @param int $sizeId    product detail
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
     * @param string $name size name
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
    public function updateProduct(array $data, Product $product)
    {
        $checkDetail = isset($data['quantity_type']);
        DB::beginTransaction();
        try {
            if ($checkDetail) {
                $quantity = 0;
                foreach ($data['quantity_type'] as $itemQuantity) {
                    $quantity = $quantity + $itemQuantity;
                }
                $product->update([
                    'name' => $data['name'],
                    'category_id' => $data['category_id'],
                    'original_price' => $data['original_price'],
                    'quantity' => $quantity,
                    'description' => $data['description'],
                ]);
                DB::table('product_details')->where('product_id', $product->id)->delete();
                for ($i=0; $i < count($data['color_id']); $i++) {
                    $productDetail = $this->checkDetailExist($product->id, $data['color_id'][$i], $data['size_id'][$i]);
                    if ($productDetail) {
                        $productDetail->quantity += $data['quantity_type'][$i];
                        $productDetail->save();
                    } else {
                        ProductDetail::create([
                            'product_id' => $product->id,
                            'color_id' => $data['color_id'][$i],
                            'size_id' => $data['size_id'][$i],
                            'quantity' => $data['quantity_type'][$i],
                        ]);
                    }
                }
            } else {
                $product->update([
                    'name' => $data['name'],
                    'category_id' => $data['category_id'],
                    'original_price' => $data['original_price'],
                    'quantity' => 0,
                    'description' => $data['description'],
                ]);
                DB::table('product_details')->where('product_id', $product->id)->delete();
            }
            if (isset($data['upload_file'])) {
                DB::table('images')->where('product_id', $product->id)->delete();
                foreach ($data['upload_file'] as $image) {
                    Image::create([
                        'product_id' => $product->id,
                        'path' => $this->uploadImage($image)
                    ]);
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
}
