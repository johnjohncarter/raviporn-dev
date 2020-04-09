<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductPriceController extends BaseController
{
    public function newProductPrice(Request $request, $user_id) {
        $validator = Validator::make($request->all(), ['products' => 'required']);
        if ($validator->fails())
            return response()->json($this->error($validator->errors()));

        $products = $request->input('products', []);
        $response = true;
        try {
            foreach ($products as $product) {
                if (isset($product['price_input'])) {
                    $data['product_id'] = $product['id'];
                    $data['user_id'] = $user_id;
                    $data['price'] = $product['price_input'];
                    $product = ProductPrice::query()->create($data);
                    if (!$product)
                        $response = false;
                }
            }
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        if (!$response)
            return response()->json($this->success('create product price successfully, and have something error !!'));
        return response()->json($this->success('create product price successfully !!'));
    }
}
