<?php

namespace App\Http\Controllers\Authen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function getSignIn()
    {
        return view('authen.sign_in');
    }

    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('sign-in')->withErrors($validator)->withInput();
        }

        $username = $request->input('username');
        $password = $request->input('password');

        try {
            $user = User::query()->where('username', $username)->first();
        } catch (\Exception $exception) {
            return redirect('contact')->withErrors($exception->getMessage())->withInput();
        }
        if (!$user) {
            return redirect('sign-in')->withErrors("don't have current user !!")->withInput();
        }

        if (!Hash::check($password, $user['password'])) {
            return redirect('sign-in')->withErrors("you password not allow !!")->withInput();
        }

        Auth::guard('user')->login($user);
        if (!Auth::guard('user')->user()) {
            return redirect('sign-in')->withErrors('this user sign in fail !!');
        }
        return redirect('dashboard');
    }

    public function getRegister()
    {
        return view('authen.register');
    }

    public function register()
    {
        return view('authen.register');
    }
}
