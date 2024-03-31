<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Tanggal Lahir',
            'NISN',
            'Nama Orang Tua',
            'Jenjang',
            'Asrama',
            'URL Foto Profil',
            'URL Kartu Identitas Orang Tua',
            'URL Kartu Keluarga',
            'URL KIP'
        ];
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->email,
            $student->date_of_birth,
            $student->nisn,
            $student->parent_name,
            $student->school_name,
            $student->boarding_status,
            $student->profile_photo_url,
            $student->id_card_parent_url,
            $student->id_family_card_url,
            $student->kip_url
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }
}
