<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function getRoles() {
        try {
            $roles = Role::query()->get();
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        return response()->json($this->success($roles));
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:20',
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'password' => 'required',
            'confirm_password' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);
        if ($validator->fails())
            return response()->json($this->error($validator->errors()));
        if ($request->input('password') != $request->input('confirm_password'))
            return response()->json($this->error('password not math !!'));

        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['surname'] = $request->input('surname');
        $data['password'] = Hash::make($request->input('password'));
        $data['email'] = $request->input('email');
        $data['phone'] = $request->input('phone', null);
        $data['line'] = $request->input('line', null);
        $data['facebook'] = $request->input('facebook', null);
        $data['role_id'] = $request->input('role');;
        $data['role'] = 'user';
        try {
            $user = User::query()->create($data);
        } catch (\Exception $exception) {
            return response()->json($this->error($exception->getMessage()));
        }
        if (!$user)
            return response()->json($this->error('new create user fail !!'));
        return response()->json($this->success($user));
    }
}
