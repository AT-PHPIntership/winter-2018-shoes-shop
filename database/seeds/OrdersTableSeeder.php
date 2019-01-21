<?php

use Illuminate\Database\Seeder;
use App\Models\Code;
use App\Models\User;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codeIds = Code::all('id');
        $userIds = User::all('id');
        for($i = 0; $i < 10; $i++){
            factory(Order::class)->create([
                'user_id' => $userIds->random(),
                'code_id' => $codeIds->random(),
            ]);
        }
    }
}
