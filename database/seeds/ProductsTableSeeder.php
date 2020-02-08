<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'O',
                'description' => 'ความยาว 200*180 cm ทรงรี',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'A',
                'description' => 'ความยาว 180*150 cm ทรงรี',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'B',
                'description' => 'ความยาว 150*120 cm ทรงรี',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'C',
                'description' => 'ความยาว 120*80 cm ทรงรี',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'J',
                'description' => 'ความยาวน้อยกว่า 80 cm ทรงรี',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Product::query()->insert($products);
    }
}
