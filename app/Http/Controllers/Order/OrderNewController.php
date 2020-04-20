<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderNewController extends Controller
{
    public function index() {
        try {
            $orders = Order::with('customer')
                ->where('order_date', '=', Carbon::today())
                ->orderBy('id', 'desc')
                ->paginate(10);
        } catch (\Exception $exception) {
            return redirect('order.order_new.order')->withErrors($exception->getMessage());
        }
        return view('order.order_new.order', ['orders' => $orders]);
    }

    public function create(Request $request) {
        return view('order.order_new.order_create');
    }

    public function view($order_id) {
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
            return redirect('order.order_new.order')->withErrors($exception->getMessage());
        }
        return view('order.order_new.order_show', ['order' => $order]);
    }

    public function edit($order_id) {}

    public function update(Request $request, $order_id) {}

    public function destroy($order_id) {}
}
