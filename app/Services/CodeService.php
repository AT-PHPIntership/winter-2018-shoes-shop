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
        return Code::with('category')->orderBy('id', config('define.orderBy.desc'))->paginate(config('define.paginate.limit_rows'));
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
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
