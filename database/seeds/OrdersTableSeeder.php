<?php

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = [
            'user_id' => 3,
            'order_date' => now(),
            'total_amount' => 200,
            'total_price' => 3300,
            'description' => 'จัดส่งให้ทันก่อน 17.00 น. นะครับ',
        ];
        $order = Order::query()->create($order);
        $order_detail = [
            [
                'product_id' => 2,
                'order_id' => $order['id'],
                'user_id' => 3,
                'amount' => 100,
                'price' => 18,
                'description' => 'ขอหวัใหญ่ๆหน่อยนะครับ',
            ],
            [
                'product_id' => 3,
                'order_id' => $order['id'],
                'user_id' => 3,
                'amount' => 100,
                'price' => 15,
                'description' => 'ขออันสวยๆหน่อย จะเอามาตั้งโชว์ลูกค้า',
            ],
        ];
        OrderDetail::query()->insert($order_detail);

        $order = [
            'user_id' => 4,
            'order_date' => now(),
            'total_amount' => 150,
            'total_price' => 2550,
            'description' => 'จัดส่งให้ทันก่อน 22.00 น. นะครับและตั้งใว้ข้างๆรถเลยเลยไม่ต้องรอคนมาขน',
        ];
        $order = Order::query()->create($order);
        $order_detail = [
            [
                'product_id' => 2,
                'order_id' => $order['id'],
                'user_id' => 4,
                'amount' => 100,
                'price' => 18,
                'description' => 'ขอหวัใหญ่ๆหน่อยนะครับ',
            ],
            [
                'product_id' => 3,
                'order_id' => $order['id'],
                'user_id' => 4,
                'amount' => 50,
                'price' => 15,
                'description' => 'ขออันสวยๆหน่อย จะเอามาตั้งโชว์ลูกค้า',
            ],
        ];
        OrderDetail::query()->insert($order_detail);
    }
}
