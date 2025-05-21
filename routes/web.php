<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\PasienExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pasien;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/export-excel-pasien', [PasienController::class, 'exportExcel'])->name('pasiens.export.excel');

Route::get('/export-excel-pendaftar', [PendaftaranController::class, 'exportExcel'])->name('pendaftaran.export.excel');

Route::get('/export-pdf-pasien', [PasienController::class, 'exportPdf'])->name('pasiens.export.pdf');

Route::get('/export-pdf-pendaftar', function () {
    $pasiens = Pasien::select('nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date')->get();
    $pdf = Pdf::loadView('exports.pasien_pdf', compact('pasiens'))->setPaper('a4', 'landscape');
    return $pdf->download('data_pendaftar.pdf');
})->name('pendaftaran.export.pdf');

Route::middleware(['auth'])->group(function () {
    Route::resource('pasiens', PasienController::class);
    Route::resource('pendaftaran', PendaftaranController::class)->except(['show']);

    Route::post('/pasiens/{id}/restore', [PasienController::class, 'restore'])->name('pasiens.restore');
    Route::delete('/pasiens/{id}/force-delete', [PasienController::class, 'forceDelete'])->name('pasiens.forceDelete');

    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/filter', [PendaftaranController::class, 'filter'])->name('pendaftaran.filter');
    Route::post('/pendaftaran/{id}/restore', [PendaftaranController::class, 'restore'])->name('pendaftaran.restore');
    Route::delete('/pendaftaran/{id}/force-delete', [PendaftaranController::class, 'forceDelete'])->name('pendaftaran.forceDelete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




