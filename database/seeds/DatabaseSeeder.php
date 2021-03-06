<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductDetailsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(ProductPromotionsTableSeeder::class);
        $this->call(CodesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
