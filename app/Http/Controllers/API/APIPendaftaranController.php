<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;

class APIPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftaran::with('pasien')->get();

        return response()->json([
            'status' => true,
            'data' => $pendaftar
        ]);
    }
}