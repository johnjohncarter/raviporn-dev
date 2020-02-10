<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index() {
        $users = User::query()->paginate(10);
        return view('manage.manage_user', ['users' => $users]);
    }
}
