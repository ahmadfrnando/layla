<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilPanenController;
use App\Http\Controllers\Admin\JadwalTugasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ManajemenKaryawanController;
use App\Http\Controllers\Admin\PemeliharaanController;
use App\Http\Controllers\Admin\PemupukanController;
use App\Http\Controllers\Admin\PengaturanPenggunaController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Petugas\ProfileController as PetugasProfileController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\HasilPanenController as PetugasHasilPanenController;
use App\Http\Controllers\Petugas\JadwalTugasController as PetugasJadwalTugasController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;
use App\Http\Controllers\Petugas\PemeliharaanController as PetugasPemeliharaanController;
use App\Http\Controllers\Petugas\PemupukanController as PetugasPemupukanController;
use App\Http\Controllers\Petugas\PengaturanPenggunaController as PetugasPengaturanPenggunaController;

use App\Http\Controllers\Manajer\ProfileController as ManajerProfileController;
use App\Http\Controllers\Manajer\DashboardController as ManajerDashboardController;
use App\Http\Controllers\Manajer\DataHasilPanenController as ManajerHasilPanenController;
use App\Http\Controllers\Manajer\KelolaJadwalTugasController as ManajerJadwalTugasController;
use App\Http\Controllers\Manajer\KelolaLaporanController as ManajerLaporanController;
use App\Http\Controllers\Manajer\DataPemeliharaanController as ManajerPemeliharaanController;
use App\Http\Controllers\Manajer\DataPemupukanController as ManajerPemupukanController;

use App\Http\Controllers\AjaxLoadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\DataOperasionalController as PimpinanDataOperasionalController;
use App\Http\Controllers\Pimpinan\ProfileController as PimpinanProfileController;
use App\Models\JadwalTugas;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
    // route yang ada
    
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:1'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/manajemen-karyawan', ManajemenKaryawanController::class);
    Route::resource('/hasil-panen', HasilPanenController::class);
    Route::resource('/pemupukan', PemupukanController::class);
    Route::resource('/pemeliharaan', PemeliharaanController::class);
    Route::resource('/jadwal-tugas', JadwalTugasController::class);
    Route::post('/jadwal-tugas/status/{id}/{status}', [JadwalTugasController::class, 'updateStatus'])->name('jadwal-tugas.status');
    Route::resource('/pengaturan-pengguna', PengaturanPenggunaController::class);
    Route::resource('/profile', ProfileController::class);
});

Route::middleware(['auth', 'role:2'])->name('petugas.')->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/hasil-panen', PetugasHasilPanenController::class);
    Route::resource('/pemupukan', PetugasPemupukanController::class);
    Route::resource('/pemeliharaan', PetugasPemeliharaanController::class);
    Route::resource('/jadwal-tugas', PetugasJadwalTugasController::class);
    Route::post('/jadwal-tugas/status/{id}/{status}', [PetugasJadwalTugasController::class, 'updateStatus'])->name('jadwal-tugas.status');
    Route::get('/laporan', PetugasLaporanController::class)->name('laporan.index');
    Route::post('/laporan', PetugasLaporanController::class)->name('laporan.cetak');
    Route::resource('/pengaturan-pengguna', PetugasPengaturanPenggunaController::class);
    Route::resource('/profile', PetugasProfileController::class);
});

Route::middleware(['auth', 'role:3'])->name('manajer.')->prefix('manajer')->group(function () {
    Route::get('/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/hasil-panen', ManajerHasilPanenController::class)->name('hasil-panen.index');
    Route::get('/pemupukan', ManajerPemupukanController::class)->name('pemupukan.index');
    Route::get('/pemeliharaan', ManajerPemeliharaanController::class)->name('pemeliharaan.index');
    Route::get('/laporan', ManajerLaporanController::class)->name('laporan.index');
    Route::post('/laporan', ManajerLaporanController::class)->name('laporan.cetak');
    Route::resource('/profile', ManajerProfileController::class);
});


Route::get('/test-dashboard', function () {
    return view('template.dashboard');
});
Route::get('/get-data', function () {
    $data = JadwalTugas::where('karyawan_id', 1)->orderBy('created_at', 'desc')->get();
    return response()->json($data);
})->name('get-data');

Route::get('/get-kode-pengangkutan', [AjaxLoadController::class, 'getKodePengangkutan'])->name('get-kode-pengangkutan');
Route::get('/search-kode-pengangkutan', [AjaxLoadController::class, 'getKodePengangkutan'])->name('search.kode-pengangkutan');
Route::get('/search-karyawan', [AjaxLoadController::class, 'getKaryawan'])->name('search.karyawan');
Route::get('/search-karyawan-pengguna', [AjaxLoadController::class, 'getKaryawanPengguna'])->name('search.karyawan-pengguna');
Route::get('/test-cetak', function () {
    return view('pages.pimpinan.data-operasional.cetak', [
        'data' => App\models\User::all(),
    ]);
});
