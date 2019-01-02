<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'm_roles';
    const ADMIN_ROLE = 1;
    const EMPLOYEE_ROLE = 2;
    const SHIPPER_ROLE = 3;
    const CUSTOMER_ROLE = 4;

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
