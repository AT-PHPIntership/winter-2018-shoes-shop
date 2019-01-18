<?php

namespace App\Services;

use App\Models\Code;
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
}
