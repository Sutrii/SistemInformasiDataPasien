<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan daftar pasien
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

    // Form tambah pasien
    public function create()
    {
        return view('pasiens.create');
    }

    // Generate nomor rekam medis otomatis
    private function generateNoRM()
    {
        $datePart = Carbon::now()->format('ymd');
        $countToday = Pasien::whereDate('register_date', now()->toDateString())->count() + 1;
        return $datePart . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }

    // Simpan data pasien baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:pasiens',
            'nama' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['no_rm'] = $this->generateNoRM();
        $validated['register_date'] = now();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            if ($foto instanceof UploadedFile && $foto->isValid()) {
                try {
                    $filename = uniqid() . '.' . $foto->getClientOriginalExtension();
                    $destinationPath = public_path('storage/foto_pasien');

                    // Buat folder jika belum ada
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $foto->move($destinationPath, $filename);
                    $validated['foto'] = 'foto_pasien/' . $filename;

                } catch (\Exception $e) {
                    Log::error("Gagal menyimpan file foto: " . $e->getMessage());
                    return back()->withErrors(['foto' => 'Gagal menyimpan file.'])->withInput();
                }
            }
        }

        Pasien::create($validated);

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    // Update data pasien
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pasien = Pasien::findOrFail($id);

        if (
            $request->hasFile('foto') &&
            $request->file('foto') instanceof UploadedFile &&
            $request->file('foto')->isValid()
        ) {
            try {
                $foto = $request->file('foto');
                $filename = uniqid() . '.' . $foto->getClientOriginalExtension();
                $destinationPath = public_path('storage/foto_pasien');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $foto->move($destinationPath, $filename);
                $validated['foto'] = 'foto_pasien/' . $filename;
            } catch (\Exception $e) {
                Log::error("Gagal update file foto: " . $e->getMessage());
                return back()->withErrors(['foto' => 'Gagal menyimpan file.'])->withInput();
            }
        }

        $pasien->update($validated);

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil dihapus');
    }

    public function show(string $id)
    {
        //
    }
}
