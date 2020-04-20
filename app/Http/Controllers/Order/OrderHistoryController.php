<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index() {
        try {
            $orders = Order::with('customer')
                ->where('order_date', '>', Carbon::today())
                ->orderBy('id', 'desc')
                ->paginate(10);
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.order_history.order', ['orders' => $orders]);
    }

    public function create(Request $request) {}

    public function view($order_id) {}

    public function edit($order_id) {}

    public function update(Request $request, $order_id) {}

    public function destroy($order_id) {}

}
