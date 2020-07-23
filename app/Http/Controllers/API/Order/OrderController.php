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
            foreach ($products as $product) {
                $current_data = [];
                $current_data['product_id'] = $product['id'];
                $current_data['order_id'] = $order['id'];
                $current_data['user_id'] = $user_id;
                $current_data['amount'] = $product['amount'];
                $current_data['price'] = $product['price'];
                $current_data['order_date'] = $data['order_date'];
                $current_data['order_time'] = $data['order_time'];
                $current_data['product_price'] = $product['product_price'];
                $current_data['product_name'] = $product['product_name'];
                OrderDetail::query()->create($current_data);
            }
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success('new create order successfully'));
    }

    public function update(Request $request, $order_id)
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
            $order = Order::query()->find($order_id)->update($data);
            foreach ($products as $product) {
                $current_data = [];
                $current_data['product_id'] = $product['id'];
                $current_data['order_id'] = $order_id;
                $current_data['user_id'] = $user_id;
                $current_data['amount'] = $product['amount'];
                $current_data['price'] = $product['price'];
                $current_data['order_date'] = $data['order_date'];
                $current_data['order_time'] = $data['order_time'];
                $current_data['product_price'] = $product['product_price'];

                if (isset($product['order_detail_id'])) {
                    $order_detail = OrderDetail::query()->find($product['order_detail_id']);
                    $order_detail->update($current_data);
                }
                else {
                    OrderDetail::query()->create($current_data);
                }
            }
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success('new create order successfully'));
    }

    public function show($order_id) {
        try {
            $order = Order::query()->with('detail', 'customer')->find($order_id);
            $order['order_date'] = date('Y-m-d', strtotime($order['order_date']));
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success($order));
    }
}
