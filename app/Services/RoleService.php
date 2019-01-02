<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    /**
     * Get all data table role
     *
     * @return object
     */
    public function getAll()
    {
        $roles = Role::get();
        return $roles;
    }
}
