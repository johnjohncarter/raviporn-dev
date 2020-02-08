<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function getCustomer() {
        try {
            $customer = User::query()->where('role', 'user')->get();
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success($customer));
    }
}
