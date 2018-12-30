<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = User::all('id');
        foreach($ids as $id){
            factory(Profile::class)->create([
                'user_id' => $id
            ]);
        }
    }
}
