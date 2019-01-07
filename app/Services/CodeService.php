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

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data data
     *
     * @return boolean
     */
    public function store($data)
    {
        try {
            Code::create($data);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get info user
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Code::findOrFail($id);
    }
}
