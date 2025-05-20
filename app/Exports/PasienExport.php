<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasienExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pasien::select('nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'No. RM',
            'Alamat',
            'Agama',
            'Tanggal Lahir',
            'Register Date'
        ];
    }
}

