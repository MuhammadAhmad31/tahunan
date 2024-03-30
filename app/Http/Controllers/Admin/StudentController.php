<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolModel;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $idSchool = $request->input('id_school');
        $isBoarding = $request->input('is_boarding');

        $userModel = User::select('id', 'name', 'email', 'id_school', 'date_of_birth', 'nisn', 'parent_name', 'is_boarding', 'profile_photo_path', 'id_card_parent', 'id_family_card', 'kip')
            ->where('role', 'user')
            ->when($idSchool, function ($query) use ($idSchool) {
                return $query->where('id_school', $idSchool);
            })
            ->when($isBoarding !== null, function ($query) use ($isBoarding) {
                return $query->where('is_boarding', $isBoarding);
            })
            ->get();


        $schools = SchoolModel::all();
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
            'detail' => $detailStudent,
            'schools' => $schools,
            'idSchool' => $idSchool,
            'isBoarding' => $isBoarding,
        ];

        return view('admin.student')->with($data);
    }
}
