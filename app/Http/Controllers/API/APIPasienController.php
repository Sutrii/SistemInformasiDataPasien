<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class APIPasienController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal');

        $query = Pasien::query();

        if ($tanggal) {
            $query->whereDate('register_date', $tanggal);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get()
        ]);
    }
}

