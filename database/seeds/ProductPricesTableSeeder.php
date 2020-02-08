<?php

use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class ProductPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            [
                'product_id' => 2,
                'user_id' => 3,
                'price' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'user_id' => 3,
                'price' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'user_id' => 4,
                'price' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'user_id' => 4,
                'price' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        ProductPrice::query()->insert($prices);
    }
}
