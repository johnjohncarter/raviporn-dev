<?php

namespace App\Http\Controllers\Authen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenController extends Controller
{
    public function signIn() {
        return view('authen.sign_in');
    }

    public function register() {
        return view('authen.sign_in');
    }
}
