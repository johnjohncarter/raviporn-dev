<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\ProductPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageUserController extends Controller
{
    public function index() {
        try {
            $users = User::query()
                ->where('role_id', '!=', 1)
                ->paginate(10);
        } catch (\Exception $exception) {
            return view('manage.user', ['exception' => $exception->getMessage()]);
        }
        return view('manage.user', ['users' => $users]);
    }

    public function create() {
        return view('manage.user_create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:20',
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'password' => 'required',
            'confirm_password' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails())
            return redirect('manage-user/create')->withErrors($validator->errors())->withInput();
        if ($request->input('password') != $request->input('confirm_password'))
            return redirect('manage-user/create')->withErrors(['password_math' => '1231331333'])->withInput();

        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['surname'] = $request->input('surname');
        $data['password'] = Hash::make($request->input('password'));
        $data['email'] = $request->input('email');
        $data['phone'] = $request->input('phone', null);
        $data['line'] = $request->input('line', null);
        $data['facebook'] = $request->input('facebook', null);
        $data['role_id'] = 3;
        $data['role'] = 'user';
        try {
            $user = User::query()->create($data);
        } catch (\Exception $exception) {
            return redirect('manage-user')->withErrors($exception->getMessage());
        }
        if (!$user)
            return redirect('manage-user')->withErrors('new create user fail !!');
        return redirect('manage-user')->withSuccess('new create user successfully !!');
    }

    public function view($user_id) {
        try {
            $user = User::with('role', 'product_price')->find($user_id)->toArray();
            $user['product_price'] = ProductPrice::query()
                ->with('product')
                ->where('user_id', $user_id)
                ->get()
                ->toArray();
//            dd($user);
        } catch (\Exception $exception) {
            return redirect('manage-user')->withErrors($exception->getMessage());
        }
        return view('manage.user_show', ['user' => $user]);
    }

    public function edit($user_id) {
        try {
            $user = User::query()->find($user_id);
        } catch (\Exception $exception) {
            return redirect('manage-user')->withErrors($exception->getMessage());
        }
        if (!$user)
            return redirect('manage-user')->withErrors('find user fail !!');
        return view('manage.user_edit', ['user' => $user]);
    }

    public function update(Request $request, $user_id) {
        try {
            $user = User::query()->find($user_id)->update($request->all());
        } catch (\Exception $exception) {
            return redirect('manage-user')->withErrors($exception->getMessage());
        }
        if (!$user)
            return redirect('manage-user')->withErrors('update user fail !!');
        return redirect('manage-user')->withSuccess('update user successfully !!');
    }

    public function destroy($user_id) {
        try {
            $user = User::query()->find($user_id)->delete();
        } catch (\Exception $exception) {
            return redirect('manage-user')->withErrors($exception->getMessage());
        }
        if (!$user)
            return redirect('manage-user')->withErrors('delete user fail !!');
        return redirect('manage-user')->withSuccess('delete user successfully !!');
    }

}
