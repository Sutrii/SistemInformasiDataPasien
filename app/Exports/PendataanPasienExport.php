<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class PendataanPasienExport implements FromCollection, WithHeadings
{
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        $query = DB::table('pasiens')
            ->join('pendaftarans', 'pasiens.no_rm', '=', 'pendaftarans.no_rm')
            ->select(
                'pendaftarans.no_pendaftaran',
                'pendaftarans.pendaftaran_date',
                'pasiens.nik',
                'pasiens.nama',
                'pasiens.no_rm',
                'pasiens.alamat',
                'pasiens.agama',
                'pasiens.tanggal_lahir',
                'pasiens.register_date'
            );

        if ($this->start && $this->end) {
            $query->whereBetween('pendaftarans.pendaftaran_date', [$this->start, $this->end]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Tanggal Pendaftaran',
            'NIK',
            'Nama',
            'No. RM',
            'Alamat',
            'Agama',
            'Tanggal Lahir',
            'Register Date',
        ];
    }
}


