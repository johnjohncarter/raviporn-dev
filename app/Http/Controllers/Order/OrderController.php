<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPrice;
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
        try {
            $product_price = ProductPrice::query()->get();
            $products = Product::query()->get();
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.new_order', ['products' => $products]);
    }

    public function orderNew()
    {
        try {
            $orders = Order::with('customer')
                ->orderBy('id', 'desc')
//                ->get();
//            dd($orders->toArray());
                ->paginate(10);
        } catch (\Exception $exception) {
            return redirect('order-new')->withErrors($exception->getMessage());
        }
        return view('order.order_new', ['orders' => $orders]);
    }

    public function orderHistory()
    {
        return view('order.order_history');
    }
}
