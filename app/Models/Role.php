<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'm_roles';
    const ADMIN_ROLE = 'Admin';
    const EMPLOYEE_ROLE = 'Employee';
    const SHIPPER_ROLE = 'Shipper';
    const CUSTOMER_ROLE = 'Customer';

    /**
     * Role has many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
