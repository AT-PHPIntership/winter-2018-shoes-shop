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
}
