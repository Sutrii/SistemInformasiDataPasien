<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalPendaftaran = Pendaftaran::count();
        $pasiens = Pasien::latest()->take(5)->get(); 
        $pendaftarans = Pendaftaran::latest()->take(5)->get();

        return view('dashboard', compact('totalPasien', 'totalPendaftaran', 'pasiens', 'pendaftarans'));
    }
}
