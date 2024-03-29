<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolModel;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $userModel = User::select('id', 'name', 'email', 'id_school', 'date_of_birth', 'nisn', 'parent_name', 'is_boarding', 'profile_photo_path', 'id_card_parent', 'id_family_card', 'kip')->where('role', 'user')->get();
        $student = [];
        $detailStudent = [];

        foreach ($userModel as $user) {
            $schoolName = SchoolModel::where('id', $user->id_school)->value('name');
            $boardingStatus = $user->is_boarding ? 'Asrama' : 'Non Asrama';

            $student[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'jenjang_pendidikan' => $schoolName,
                'tanggal_lahir' => $user->date_of_birth,
                'nisn' => $user->nisn,
                'orang_tua' => $user->parent_name,
                'asrama' => $boardingStatus,
            ];

            $detailStudent[$user->id] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'jenjang_pendidikan' => $schoolName,
                'tanggal_lahir' => $user->date_of_birth,
                'nisn' => $user->nisn,
                'asrama' => $boardingStatus,
                'profile_photo_path' => $user->profile_photo_path,
                'id_card_parent' => $user->id_card_parent,
                'id_family_card' => $user->id_family_card,
                'kip' => $user->kip,
                'is_boarding' => $user->is_boarding ? 'Asrama' : 'Non Asrama',
            ];
        }

        $actionIcons = [
            "icon:eye | tip:lihat detail | color:green | click:getDetail('{id}')",
        ];

        $data = [
            'students' => $student,
            'action_icons' => $actionIcons,
            'detail' => $detailStudent
        ];

        return view('admin.student')->with($data);
    }
}
