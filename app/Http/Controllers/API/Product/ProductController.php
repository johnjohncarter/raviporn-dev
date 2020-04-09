<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index() {
        try {
            $product = Product::query()->get();
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success($product));
    }

    public function getProduct(Request $request) {
        $user_id = $request->input('user_id', null);
        if (!$user_id) {
            return response()->json($this->error('do not have user id !!'));
        }
        try {
            $product = Product::with(['price' => function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }])->get();
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success($product));
    }
}
