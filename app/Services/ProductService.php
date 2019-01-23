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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'original_price', 'quantity', 'description'
    ];

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
        return Product::findOrFail($id);
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
        $quantity = 0;
        foreach ($data['quantity_type'] as $item_quantity) {
            $quantity = $quantity + $item_quantity;
        }
        DB::beginTransaction();
        try {
            $new_product = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'original_price' => $data['original_price'],
                'quantity' => $quantity,
                'description' => $data['description'],
            ]);
            for ($i=0; $i < count($data['color_id']); $i++) {
                ProductDetail::create([
                    'product_id' => $new_product->id,
                    'color_id' => $data['color_id'][$i],
                    'size_id' => $data['size_id'][$i],
                    'quantity' => $data['quantity_type'][$i],
                ]);
            }
            foreach ($data['upload_file'] as $key => $image) {
                Image::create([
                    'product_id' => $new_product->id,
                    'path' => $this->uploadImage($image)
                ]);
            }
            DB::commit();
            return $new_product;
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
     * Handle process import file csv including products data.
     *
     * @param \Illuminate\Http\Request $data of products
     *
     * @return \Illuminate\Http\Response
     */
    public function importData($data)
    {
        foreach ($data as $key => $value) {
            $category_id = $this->getCategoryByName($value->category);
            $size_id = $this->getSizeByName($value->size);
            $color_id = $this->getColorByName($value->color);
            if ((!$category_id) || (!$size_id) || (!$color_id)) {
                session()->flash('error', trans('common.message.file_error', ['line' => $key + 2]));
                return false;
            }
        }
        foreach ($data as $key => $value) {
            $category_id = $this->getCategoryByName($value->category);
            $size_id = $this->getSizeByName($value->size);
            $color_id = $this->getColorByName($value->color);
            $checkName = $this->checkNameExist($value->name);
            if ($checkName) {
                $product = $this->checkInfoCorrect($value->name, $category_id, $value->original_price, $value->description);
                if (!$product) {
                    session()->flash('error', trans('common.message.file_error', ['line' => $key + 2]));
                    return false;
                }
                if ($product) {
                        $product->quantity += $value->quantity;
                        $product->save();
                    try {
                        $productDetail = $this->checkDetailExist($product->id, $color_id, $size_id);
                        if ($productDetail) {
                            $productDetail->quantity += $value->quantity;
                            $productDetail->save();
                        } else {
                            ProductDetail::create([
                                'product_id' => $product->id,
                                'color_id' => $color_id,
                                'size_id' => $size_id,
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
                        'category_id' => $category_id,
                        'original_price' => $value->original_price,
                        'quantity' => $value->quantity,
                        'description' => $value->description,
                    ]);
                    ProductDetail::create([
                        'product_id' => $product->id,
                        'color_id' => $color_id,
                        'size_id' => $size_id,
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
     * @param string $name           product
     * @param int    $category_id    product
     * @param string $original_price product
     * @param string $description    product
     *
     * @return boolean
     */
    public function checkInfoCorrect($name, $category_id, $original_price, $description)
    {
        $product = Product::where('name', $name)
                    ->where('category_id', $category_id)
                    ->where('original_price', $original_price)
                    ->where('description', $description)
                    ->first();
        return $product;
    }

    /**
     * Check if product detail is exist
     *
     * @param int $product_id product detail
     * @param int $color_id   product detail
     * @param int $size_id    product detail
     *
     * @return boolean
     */
    public function checkDetailExist($product_id, $color_id, $size_id)
    {
        $productDetail = ProductDetail::where('product_id', $product_id)
                    ->where('color_id', $color_id)
                    ->where('size_id', $size_id)
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
}
