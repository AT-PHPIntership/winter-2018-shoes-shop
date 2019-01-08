<?php

namespace App\Services;

use App\Models\Code;

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
}
