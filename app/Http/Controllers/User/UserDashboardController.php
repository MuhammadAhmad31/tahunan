<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function index()
    {

        $user_id = Session::get('user_id');
        $userModel = User::select('id', 'name', 'email', 'id_school', 'date_of_birth', 'nisn', 'parent_name', 'is_boarding', 'profile_photo_path', 'id_card_parent', 'id_family_card', 'kip')
            ->where('role', 'user')
            ->where('id', $user_id)
            ->first();

        $schoolName = SchoolModel::where('id', $userModel->id_school)->value('name');

        $boardingStatus = $userModel->is_boarding ? 'Asrama' : 'Non Asrama';

        $data = [
            'id' => $userModel->id,
            'name' => $userModel->name,
            'email' => $userModel->email,
            'jenjang_pendidikan' => $schoolName,
            'tanggal_lahir' => $userModel->date_of_birth,
            'nisn' => $userModel->nisn,
            'orang_tua' => $userModel->parent_name,
            'asrama' => $boardingStatus,
            'profile_photo_path' => $userModel->profile_photo_path,
            'id_card_parent' => $userModel->id_card_parent,
            'id_family_card' => $userModel->id_family_card,
            'kip' => $userModel->kip,
        ];

        // dd($data);

        return view('user.dashboard')->with($data);
    }
}
