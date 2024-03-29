<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function index()
    {
        $sesion = Session::get('user_role');
        // dd($sesion);
        return view('user.dashboard');
    }
}
