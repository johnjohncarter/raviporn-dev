<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderNewController extends Controller
{
    public function index(Request $request) {
        $product = $request->input('product', null);
        $customer = $request->input('customer', null);

        $current_query = ['customer'];
        if ($product) {
            $current_query = ['customer', 'detail_order' => function($query) use($product) {
                $query->when($product, function ($query) use ($product) {
                    $query->where('product_name', $product);
                });
            }];
        }
        try {
            $orders = Order::with($current_query)
                ->where('order_date', '>=', Carbon::today())
                ->when($product, function ($query) use ($product) {
                    $query->whereHas('detail_order', function ($query) use ($product) {
                        $query->where('product_name', $product);
                    });
                })
                ->when($customer, function ($query) use ($customer) {
                    $query->whereHas('customer', function ($query) use ($customer) {
                        $query->where('name', $customer);
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate(15);
        } catch (\Exception $exception) {
            return redirect('order.order_new.order')->withErrors($exception->getMessage());
        }
        return view('order.order_new.order', ['orders' => $orders]);
    }

    public function create(Request $request) {
        return view('order.order_new.order_create');
    }

    public function isPay($order_id) {
        try {
            $order = Order::query()->find($order_id)->update(['is_pay' => true]);
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        if (!$order)
            return redirect('order-new')->withErrors('update pay fail !!');
        return redirect('order-new')->withSuccess('update pay successfully !!');
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
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.order_new.order_show', ['order' => $order]);
    }

    public function edit($order_id) {
        return view('order.order_new.order_edit');
    }

    public function update(Request $request, $order_id) {}

    public function destroy($order_id) {
        try {
            $order = Order::query()->find($order_id)->delete();
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        if (!$order)
            return redirect('order-new')->withErrors('delete order fail !!');

        try {
            $order = OrderDetail::query()->where('order_id', $order_id)->delete();
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        if (!$order)
            return redirect('order-new')->withErrors('delete order success and detail fail !!');
        return redirect('order-new')->withSuccess('delete order successfully !!');
    }
}
