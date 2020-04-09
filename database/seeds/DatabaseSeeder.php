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
         $this->call(UserTableSeeder::class);
         $this->call(OrdersTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ProductPricesTableSeeder::class);
         $this->call(RoleTableSeeder::class);
    }
}
