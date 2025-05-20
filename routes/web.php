<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\PasienExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pasien;

Route::get('/pasiens', [PasienController::class, 'index'])->name('dashboard');

Route::redirect('/', '/pasiens');

Route::get('/export-excel', function () {
    return Excel::download(new PasienExport, 'data_pasien.xlsx');
})->name('pasiens.export.excel');

Route::get('/export-pdf', function () {
    $pasiens = Pasien::select('nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date')->get();
    $pdf = Pdf::loadView('exports.pasien_pdf', compact('pasiens'))->setPaper('a4', 'landscape');
    return $pdf->download('data_pasien.pdf');
})->name('pasiens.export.pdf');

Route::middleware(['auth'])->group(function () {
    Route::resource('pasiens', PasienController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



