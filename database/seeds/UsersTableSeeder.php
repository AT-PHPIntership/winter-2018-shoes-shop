<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = Role::all('id');
        factory(User::class, 10)->create([
            'role_id' => $ids->random()
        ]); 
    }
}
