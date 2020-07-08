<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {

        try {
            $orders = Product::with(['order_amount' => function($query) {
                $query->where('order_date', '>=', Carbon::today());
            }])->get();
            $products = [];
            foreach ($orders as $index => $order) {
                $current_data = $order;
                $current_data['order_amount'] = $order->order_amount->sum('amount');
                if ($current_data['order_amount'])
                    array_push($products, $current_data);
            }
        } catch (\Exception $exception) {
            return view('dashboard.dashboard', ['errors' => $exception->getMessage()]);
        }
        return view('dashboard.dashboard', ['orders' => $products]);
    }
}
