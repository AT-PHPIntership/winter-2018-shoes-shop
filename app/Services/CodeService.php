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
    public function getAll()
    {
        return User::latest()->with('category')->paginate(config('define.paginate.limit_rows'));
    }
}
