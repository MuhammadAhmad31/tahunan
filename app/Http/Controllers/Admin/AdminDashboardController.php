<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{

    protected $role;

    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'role' => Session::get('user_role'),
        ];

        // dd($data);

        return view('admin.dashboard')->with($data);
    }
}
