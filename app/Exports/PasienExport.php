<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PasienExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = DB::table('pasiens')
            ->select('nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date');

        if (!empty($this->tanggal)) {
            $query->whereDate('register_date', $this->tanggal);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['NIK', 'Nama', 'No. RM', 'Alamat', 'Agama', 'Tanggal Lahir', 'Register Date'];
    }
}


