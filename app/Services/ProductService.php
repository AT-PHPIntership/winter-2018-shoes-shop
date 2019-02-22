<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
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
            $dataProductDetails = $this->checkDuplicate($data['color_id'], $data['size_id'], $data['quantity_type']);
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
            for ($j = 0; $j < $i; $j++) { //compare each data in output
                if (($colors[$i] == $output[$j]['color']) && ($sizes[$i] == $output[$j]['size'])) {
                    $output[$j]['quantity'] += $quantities[$i];
                    break;
                }
            }
            if ($j == $i) { //add data to output if not exist
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
        foreach ($data as $key => $value) {
            $categoryId = $this->getCategoryByName($value->category);
            $sizeId = $this->getSizeByName($value->size);
            $colorId = $this->getColorByName($value->color);
            $checkName = $this->checkNameExist($value->name);
            DB::beginTransaction();
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
        DB::beginTransaction();
        try {
            $this->updateProduct($product->id, $data['name'], $categoryId, $data['original_price'], $quantity, $data['description']);
            DB::table('product_details')->where('product_id', $product->id)->delete();
            $dataProductDetails = $this->checkDuplicate($data['color_id'], $data['size_id'], $data['quantity_type']);
            foreach ($dataProductDetails as $detail) {
                $this->createProductDetail($product->id, $detail['color'], $detail['size'], $detail['quantity']);
            }
            if (isset($data['upload_file'])) {
                DB::table('images')->where('product_id', $product->id)->delete();
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
}
