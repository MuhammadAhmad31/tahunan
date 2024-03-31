<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(Request $request)
    {
        $idSchool = $request->input('id_school');
        $isBoarding = $request->input('is_boarding');

        $students = User::select('name', 'email', 'id_school', 'date_of_birth', 'nisn', 'parent_name', 'is_boarding', 'profile_photo_path', 'id_card_parent', 'id_family_card', 'kip')
            ->where('role', 'user')
            ->when($idSchool, function ($query) use ($idSchool) {
                return $query->where('id_school', $idSchool);
            })
            ->when($isBoarding !== null, function ($query) use ($isBoarding) {
                return $query->where('is_boarding', $isBoarding);
            })
            ->get();

        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No data found for export.');
        }

        foreach ($students as $student) {
            $student->school_name = SchoolModel::where('id', $student->id_school)->value('name');
            unset($student->id_school);

            // Mengubah status asrama menjadi teks yang sesuai
            $student->boarding_status = $student->is_boarding ? 'Asrama' : 'Non Asrama';
            unset($student->is_boarding);

            // Mendapatkan URL gambar untuk setiap jenis gambar
            $student->profile_photo_url = $student->profile_photo_path ? url(Storage::url($student->profile_photo_path)) : null;
            $student->id_card_parent_url = $student->id_card_parent ? url(Storage::url($student->id_card_parent)) : null;
            $student->id_family_card_url = $student->id_family_card ? url(Storage::url($student->id_family_card)) : null;
            $student->kip_url = $student->kip ? url(Storage::url($student->kip)) : null;
        }

        return Excel::download(new StudentsExport($students), 'students.xlsx');
    }
}
