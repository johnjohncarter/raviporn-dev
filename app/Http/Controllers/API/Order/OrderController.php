<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_date' => 'required',
            'order_time' => 'required',
            'products' => 'required',
            'total_amount' => 'required',
            'total_price' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($this->error($validator->errors()));
        }

        $products = $request->input('products', []);
        $user_id = $request->input('user_id', null);

        $data['user_id'] = $user_id;
        $data['order_date'] = $request->input('order_date');
        $data['order_time'] = $request->input('order_time');
        $data['description'] = $request->input('description');
        $data['total_amount'] = $request->input('total_amount');
        $data['total_price'] = $request->input('total_price');
        try {
            $order = Order::query()->create($data);
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        if (!$order) {
            return response()->json($this->error('new create order fail !!'));
        }

        try {
            foreach ($products as $product) {
                $data = [];
                $data['product_id'] = $product['id'];
                $data['order_id'] = $order['id'];
                $data['user_id'] = $user_id;
                $data['amount'] = $product['amount'];
                $data['price'] = $product['price'];
                OrderDetail::query()->create($data);
            }
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success('new create order successfully'));
    }
}
