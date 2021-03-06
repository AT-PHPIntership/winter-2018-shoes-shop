<?php

namespace App\Services;

use App\Models\Code;
use App\Models\Product;
use App\Models\UserCode;
use App\Models\Category;
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
     * @param string $codeName codeName
     * @param array  $products products
     *
     * @return int
     */
    public function getDecreaseTotalAmount(string $codeName, array $products)
    {
        try {
            $code = Code::where('name', $codeName)
                        ->where('times', '>', 0)
                        ->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now())
                        ->first();
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
                    if (Category::where('parent_id', $cateogryId)->count()) {
                        $ids = Category::where('parent_id', $cateogryId)->orWhere('id', $cateogryId)->pluck('id')->toArray();
                    } else {
                        $ids = Category::where('id', $cateogryId)->pluck('id')->toArray();
                    }
                    foreach ($products as $pd) {
                        $product = Product::with(['promotions' => function ($query) {
                            $query->where('start_date', '<=', Carbon::now())
                                ->where('end_date', '>=', Carbon::now());
                        }])->where('id', $pd['id'])->whereIn('category_id', $ids)->first();
                        if ($product) {
                            $price = $product->promotions->last() ? ($product->original_price * (100 - $product->promotions->last()->percent))/100 : $product->original_price;
                            $amountDecrease += ($price * $code->percent / 100) * $pd['quantity'];
                        }
                    }
                }
                return $amountDecrease;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Check code with user
     *
     * @param string $codeName codeName
     * @param int    $userId   userId
     *
     * @return boolean
     */
    public function checkCodeWithUser(string $codeName, int $userId)
    {
        try {
            $code = Code::where('name', $codeName)->firstOrFail();
            return UserCode::where('user_id', $userId)->where('code_id', $code->id)->firstOrFail();
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
