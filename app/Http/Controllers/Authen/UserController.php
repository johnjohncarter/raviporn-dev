<?php

namespace App\Http\Controllers\Authen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signOut()
    {
        Auth::guard('user')->logout();
        return redirect('sign-in');
    }
}
