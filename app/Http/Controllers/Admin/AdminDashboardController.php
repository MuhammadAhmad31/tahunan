<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
