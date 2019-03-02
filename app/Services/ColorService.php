<?php

namespace App\Services;

use App\Models\Color;
use Log;

class ColorService
{
    /**
     * Get data from colors table
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getColors(array $columns = ['*'])
    {
        return Color::get($columns);
    }

    /**
     * Get all data table colors with paginate
     *
     * @return Color
     */
    public function getColorWithPaginate()
    {
        return Color::orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return Color
     */
    public function store(array $data)
    {
        try {
            return Color::create($data);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data  data
     * @param Color $color color
     *
     * @return Color
     */
    public function update(array $data, Color $color)
    {
        try {
            return $color->update($data);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param Color $color color
    *
    * @return boolean
    */
    public function destroy(Color $color)
    {
        try {
            return $color->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
