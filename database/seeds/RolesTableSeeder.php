<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('m_roles')->truncate();
        $role = [
            [
                'name' => Role::ADMIN_ROLE,
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => Role::EMPLOYEE_ROLE,
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => Role::SHIPPER_ROLE,
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => Role::CUSTOMER_ROLE,
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
        ];
        \DB::table('m_roles')->insert($role);
    }
}
