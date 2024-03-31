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
        $userCount = User::where('role', 'user')->count();
        $userMTSCount = User::where('role', 'user')->where('id_school', 8375467834564853)->count();
        $userMACount = User::where('role', 'user')->where('id_school', 348723834324)->count();
        $userSMKCount = User::where('role', 'user')->where('id_school', 848763583465)->count();

        $data = [
            'userCount' => $userCount,
            'userMACount' => $userMACount,
            'userMTSCount' => $userMTSCount,
            'userSMKCount' => $userSMKCount,
        ];

        return view('admin.dashboard')->with($data);
    }
}
