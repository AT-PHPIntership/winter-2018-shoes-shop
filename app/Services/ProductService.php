<?php

namespace App\Services;

use App\Models\Product;
use File;
use Illuminate\Support\Facades\Log;

class ProductService
{
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
     * Get categoriy by id
     *
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
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
                foreach($product->images as $image) {
                    File::delete(public_path('upload/'.$image->path));
                }
            }
            return $product->delete();
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
