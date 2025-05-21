<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Pendaftaran::withTrashed();

        if ($request->filled('tanggal')) {
            $query->whereDate('pendaftaran_date', $request->tanggal);
        }

        $pendaftaran = $query->orderByDesc('pendaftaran_date')->get();

        return view('pendaftaran', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    private function generateNoPendaftaran()
    {
        $datePart = Carbon::now()->format('ymd');
        $countToday = Pendaftaran::whereDate('pendaftaran_date', now()->toDateString())->count() + 1;
        return $datePart . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_rm' => 'required'
        ]);

        $validated['no_pendaftaran'] = $this->generateNoPendaftaran();
        $validated['pendaftaran_date'] = now();

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Berhasil Mendaftarkan Pasien');
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_rm' => 'required'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete(); 

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus (soft delete).');
    }

    public function forceDelete($id)
    {
        $pendaftaran = Pendaftaran::onlyTrashed()->findOrFail($id);
        $pendaftaran->forceDelete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran dihapus permanen.');
    }

    public function restore($id)
    {
        $pendaftaran = Pendaftaran::onlyTrashed()->findOrFail($id);
        $pendaftaran->restore();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dikembalikan');
    }
}
