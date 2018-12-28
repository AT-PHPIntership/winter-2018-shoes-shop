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
        for($i = 0; $i < 10; $i++){
            factory(User::class)->create([
                'role_id' => $ids->random()
            ]); 
        }
    }
}
