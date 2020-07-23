<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {

        $color = ['bg-fuchsia', 'bg-purple', 'bg-danger', 'bg-blue', 'bg-warning', 'bg-info', ];
        try {
            $orders = Product::with(['order_amount' => function($query) {
                $query->where('order_date', '>=', Carbon::today());
            }])->get();
            $products = [];
            $index_color = 0;
            foreach ($orders as $index => $order) {
                if ($index_color > 5)
                    $index_color = 0;

                $current_data = $order;
                $current_data['order_amount'] = $order->order_amount->sum('amount');
                $current_data['bg_color'] = $color[$index_color];
                array_push($products, $current_data);
                $index_color++;
            }
        } catch (\Exception $exception) {
            return view('dashboard.dashboard', ['errors' => $exception->getMessage()]);
        }
        return view('dashboard.dashboard', ['orders' => $products]);
    }
}
