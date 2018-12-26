<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'Admin',
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'Employee',
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'Shipper',
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'Customer',
                'created_at' => \Carbon\Carbon::now(),
                'updated_At' => \Carbon\Carbon::now()
            ],
        ];
        \DB::table('roles')->insert($role);
    }
}
