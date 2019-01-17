<?php

namespace App\Services;

use App\Models\Code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * @return boolean
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $code = Code::create($data);
            DB::commit();
            return $code;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }
}
