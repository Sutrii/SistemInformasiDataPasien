<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Carbon;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('register_date', $request->tanggal);
        }

        $pasiens = $query->orderByDesc('register_date')->get();

        return view('dashboard', [
            'pasiens' => $pasiens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function generateNoRM()
    {
        $datePart = Carbon::now()->format('ymd');
        $countToday = Pasien::whereDate('register_date', now()->toDateString())->count() + 1;
        return $datePart . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:pasiens',
            'nama' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $validated['no_rm'] = $this->generateNoRM();
        $validated['register_date'] = now();

        Pasien::create($validated);

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
