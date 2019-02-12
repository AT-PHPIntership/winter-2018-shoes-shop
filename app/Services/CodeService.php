<?php

namespace App\Services;

use App\Models\Code;
use App\Models\Product;
use Log;

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
     * @param string $code       code
     * @param array  $productIds productIds
     *
     * @return \Illuminate\Http\Response
     */
    public function applyCode(string $code, array $productIds)
    {
        $data = [];
        $code = Code::where('name', $code)->first();
        if ($code) {
            $cateogry_id = $code->category_id;
            $data['status'] = true;
            $data['percent'] = $code->percent;
            if (!$cateogry_id) {
                $data['apply'] = $productIds;
            } else {
                foreach ($productIds as $productId) {
                    if (Product::where('id', $productId)->where('category_id', $cateogry_id)->count()) {
                        $data['apply'][] = $productId;
                    }
                }
            }
            return $data;
        }
        $data['status'] = false;
        return $data;
    }
}
