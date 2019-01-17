<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Category;
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
        $arr = [];
        foreach ($data as $key => $value) {
            $category_id = $this->checkNameExist($value->category);
            if ($category_id) {
                $checkName = $this->checkNameExist($value->name);
                if ($checkName) {                     
                    $checkInfo = $this->checkInfoCorrect($value->name, $category->id, $value->original_price, $value->description);
                    if (checkInfo) {
    //caculate                        $quantity = ... + $value->quantity;
                        try {
                            ProductDetail::create([

                            ]);
                        } catch (Exception $e) {
                            Log::error($e);
                            DB::rollback();
                        }
                    }
                } else {
                    try {
                        Product::create([
                            'name' => $data['name'],
                            'category_id' => $data['category_id'],
                            'original_price' => $data['original_price'],
                            'quantity' => $quantity,
                            'description' => $data['description'],
                        ]);
                        ProductDetail::create([

                        ]);
                    } catch (Exception $e) {
                        Log::error($e);
                        DB::rollback();
                    }
                }
            } else {
                session()->flash('error', __('common.file_error'));
            }
        }
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
     * @param int    $category_id product
     * @param string $price       product
     * @param string $description product
     *
     * @return boolean
     */
    public function checkInfoCorrect($name, $category_id, $price, $description)
    {
        $product = Product::where('name', $name)->first();
        dd($product);
        return true;
    }

    /**
     * get id of category
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
}
