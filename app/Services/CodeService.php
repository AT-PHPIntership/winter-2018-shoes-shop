<?php

namespace App\Services;

use App\Models\Code;
use App\Models\Product;
use Log;
use Carbon\Carbon;

class CodeService
{
    /**
     * Get all data table codes
     *
     * @return object
     */
    public function getCodeWithPaginate()
    {
        return Code::with('category')->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return Code
     */
    public function store(array $data)
    {
        try {
            $code = Code::create($data);
            return $code;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array           $data data
     * @param App\Models\Code $code code
     *
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, Code $code)
    {
        try {
            $code->update($data);
            return $code;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param App\Models\Code $code code
    *
    * @return \Illuminate\Http\Response
    */
    public function destroy(Code $code)
    {
        try {
            return $code->delete();
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }

    /**
     * Apply Code
     *
     * @param string $code     code
     * @param array  $products products
     *
     * @return \Illuminate\Http\Response
     */
    public function applyCode(string $code, array $products)
    {
        $code = Code::where('name', $code)->first();
        if ($code) {
            $cateogryId = $code->category_id;
            $amountDecrease = 0;
            if (!$cateogryId) {
                foreach ($products as $pd) {
                    $product = Product::with(['promotions' => function ($query) {
                        $query->where('start_date', '<=', Carbon::now())
                              ->where('end_date', '>=', Carbon::now());
                    }])->find($pd['id']);
                    if ($product) {
                        $price = $product->promotions->last() ? ($product->original_price * (100 - $product->promotions->last()->percent))/100 : $product->original_price;
                        $amountDecrease += ($price * $code->percent / 100) * $pd['quantity'];
                    }
                }
            } else {
                foreach ($products as $pd) {
                    $product = Product::with(['promotions' => function ($query) {
                        $query->where('start_date', '<=', Carbon::now())
                              ->where('end_date', '>=', Carbon::now());
                    }])->where('id', $pd['id'])->where('category_id', $cateogryId)->first();
                    if ($product) {
                        $price = $product->promotions->last() ? ($product->original_price * (100 - $product->promotions->last()->percent))/100 : $product->original_price;
                        $amountDecrease += ($price * $code->percent / 100) * $pd['quantity'];
                    }
                }
            }
            return $amountDecrease;
        } else {
            return null;
        }
    }
}
