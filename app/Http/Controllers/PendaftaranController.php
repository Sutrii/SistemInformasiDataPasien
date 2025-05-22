<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Exports\PendataanPasienExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $pasiens = Pasien::all();

        return view('pendaftaran', [
            'pendaftaran' => $pendaftaran,
            'pasiens' => $pasiens
        ]);
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function filter(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Pendaftaran::withTrashed();

        if ($start && $end) {
            $start = Carbon::parse($start);
            $end = Carbon::parse($end)->endOfDay();         
            $query->whereBetween('pendaftaran_date', [$start, $end]);
        }

        $pendaftaran = $query->orderByDesc('pendaftaran_date')->with('pasien')->get();
        $pasiens = Pasien::all();

        return view('pendaftaran', [
            'pendaftaran' => $pendaftaran,
            'pasiens' => $pasiens,
            'start' => $start,
            'end' => $end
        ]);
    }

    private function generateNoPendaftaran()
    {
        $datePart = Carbon::now()->format('ymd');

        $latestPendaftar = Pendaftaran::withTrashed()
            ->where('no_pendaftaran', 'like', $datePart . '-%')
            ->orderByDesc('no_pendaftaran')
            ->first();

        if ($latestPendaftar){
            $lastNumber = (int)substr($latestPendaftar->no_pendaftaran, -6);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $datePart . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_rm' => 'required|exists:pasiens,no_rm',
        ]);

        $validated['no_pendaftaran'] = $this->generateNoPendaftaran();
        $validated['pendaftaran_date'] = now();

        $pasiens = Pasien::where('no_rm', $validated['no_rm'])->first();
        $validated['nama'] = $pasiens->nama;

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Berhasil Mendaftarkan Pasien');
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pendaftaran_date' => 'required|date',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'pendaftaran_date' => $validated['pendaftaran_date']
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Tanggal pendaftaran berhasil diperbarui');
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

    public function exportExcel(Request $request)
    {
        $start = $request->query('start_date');
        $end = $request->query('end_date');

        return Excel::download(new PendataanPasienExport($start, $end), 'data_pendaftaran.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $start = $end = null;
        $query = Pendaftaran::with('pasien')->withTrashed();

        if (!empty($startDate) && !empty($endDate)) {
            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate)->endOfDay(); // penting untuk mengikutkan jam terakhir hari itu

            $query->whereBetween('pendaftaran_date', [$start, $end]);
        }

        $pendaftaran = $query->orderByDesc('pendaftaran_date')->get();

        $pdf = Pdf::loadView('exports.pendataan_pdf', compact('pendaftaran', 'start', 'end'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('data_pendaftar.pdf');
    }
}
