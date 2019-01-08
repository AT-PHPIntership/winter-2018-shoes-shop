<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    /**
     * Get all data table role
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getAll(array $columns = ['*'])
    {
        return Role::select($columns)->get();
    }
}
