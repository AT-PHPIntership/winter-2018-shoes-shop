<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Image;
use DB;
use Log;
use Session;
use Illuminate\Http\UploadedFile;

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
     * Get specified product by id
     *
     * @param array $data product
     *
     * @return \Illuminate\Http\Response
     */
    public function handleStoreProduct($data)
    {
        $quantity = 0;
        foreach ($data['quantity_type'] as $itemQuantity) {
            $quantity = $quantity + $itemQuantity;
        }
        $categoryId = isset($data['child_category_id']) ? $data['child_category_id'] : $data['parent_category_id'];
        DB::beginTransaction();
        try {
            $newProduct = $this->createProduct($data['name'], $categoryId, $data['original_price'], $quantity, $data['description']);
            for ($i=0; $i < count($data['color_id']); $i++) {
                $productDetail = $this->checkDetailExist($newProduct->id, $data['color_id'][$i], $data['size_id'][$i]);
                if ($productDetail) {
                    $productDetail->quantity += $data['quantity_type'][$i];
                    $productDetail->save();
                } else {
                    $this->createProductDetail($newProduct->id, $data['color_id'][$i], $data['size_id'][$i], $data['quantity_type'][$i]);
                }
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
                            'product_id' => $productId,
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
     * Store product detail of each product
     *
     * @param string $name          product  name
     * @param int    $categoryId    category id
     * @param int    $originalPrice size id
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
}
