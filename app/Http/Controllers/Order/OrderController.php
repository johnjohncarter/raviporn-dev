<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.order');
    }

    public function getNewOrder()
    {
        return view('order.new_order');
    }

    public function orderNew()
    {
        try {
            $orders = Order::with('customer')
                ->where('order_date', '>=', Carbon::today())
                ->orderBy('id', 'desc')
                ->paginate(10);
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.order_new', ['orders' => $orders]);
    }

    public function orderHistory()
    {
        try {
            $orders = Order::with('customer')
                ->where('order_date', '<', Carbon::today())
                ->orderBy('id', 'desc')
                ->paginate(10);
        } catch (\Exception $exception) {
            return redirect('order-history')->withErrors($exception->getMessage());
        }
        return view('order.order_history', ['orders' => $orders]);
    }

    public function show($order_id)
    {
        try {
            $order = Order::query()->find($order_id);
            $user_id = $order['user_id'];
            $order_detail = OrderDetail::with(
                ['product', 'product_price' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }])
                ->where('order_id', $order_id)
                ->get();
            $order['detail'] = $order_detail;
            $order['order_date'] = date('Y-m-d');
            $order['order_time'] = date('H:i');
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.order_new.order_show', ['order' => $order]);
    }
}
