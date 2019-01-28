<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function storeProduct($data)
    {
        $categoryId = isset($data['child_category_id']) ? $data['child_category_id'] : $data['parent_category_id'];
        DB::beginTransaction();
        try {
            if (isset($data['quantity_type'])) {
                $quantity = 0;
                foreach ($data['quantity_type'] as $itemQuantity) {
                    $quantity = $quantity + $itemQuantity;
                }
                $newProduct = Product::create([
                    'name' => $data['name'],
                    'category_id' => $categoryId,
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
                Product::create([
                    'name' => $data['name'],
                    'category_id' => $categoryId,
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
}
