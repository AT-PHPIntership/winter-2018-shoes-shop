<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user){
            factory(App\Models\Profile::class)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
