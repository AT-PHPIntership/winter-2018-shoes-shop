<?php

namespace App\Services;

use App\Models\Size;
use Log;

class SizeService
{
    /**
     * Get data form table size
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getSizes(array $columns = ['*'])
    {
        return Size::get($columns);
    }

    /**
     * Get all data table sizes with paginate
     *
     * @return Size
     */
    public function getSizeWithPaginate()
    {
        return Size::orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return Size
     */
    public function store(array $data)
    {
        try {
            return Size::create(['size' => $data['name']]);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data data
     * @param Size  $size size
     *
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, Size $size)
    {
        try {
            return $size->update(['size' => $data['name']]);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param Size $size size
    *
    * @return \Illuminate\Http\Response
    */
    public function destroy(Size $size)
    {
        try {
            return $size->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
