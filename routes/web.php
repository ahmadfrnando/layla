<?php

use App\Http\Controllers\Admin\AfdelingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilPanenController;
use App\Http\Controllers\Admin\JadwalTugasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ManajemenKaryawanController;
use App\Http\Controllers\Admin\PemeliharaanController;
use App\Http\Controllers\Admin\PemupukanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PengaturanPenggunaController;
use App\Http\Controllers\Admin\PenggunaHakAksesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupirController;
use App\Http\Controllers\AjaxLoadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Afdeling\DashboardController as AfdelingDashboardController;
use App\Http\Controllers\Afdeling\ProfileController as AfdelingProfileController;
use App\Http\Controllers\Afdeling\SupirController as AfdelingSupirController;
use App\Http\Controllers\Afdeling\HasilPanenController as AfdelingHasilPanenController;
use App\Http\Controllers\Afdeling\TambahMuatanController as AfdelingTambahMuatanController;
use App\Http\Controllers\Afdeling\JadwalOperasionalController as AfdelingJadwalOperasionalController;
use App\Models\Afdeling;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\DataOperasionalController as PimpinanDataOperasionalController;
use App\Http\Controllers\Pimpinan\ProfileController as PimpinanProfileController;

use App\Models\Pemeliharaan;
use App\Models\Pengangkutan;
use App\Models\PengangkutanHasilPanen;
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
    Route::get('/laporan', LaporanController::class)->name('laporan.index');
    Route::post('/laporan', LaporanController::class)->name('laporan.cetak');
    Route::resource('/pengaturan-pengguna', PengaturanPenggunaController::class);
    Route::resource('/profile', ProfileController::class);
});

// Group untuk afdeling tanpa Route::namespace()
Route::middleware(['auth', 'role:2'])->name('afdeling.')->prefix('afdeling')->group(function () {
    Route::get('/dashboard', [AfdelingDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/profile', AfdelingProfileController::class);
    Route::resource('/supir', AfdelingSupirController::class);
    Route::resource('/hasil-panen', AfdelingHasilPanenController::class);
    Route::resource('/tambah-muatan', AfdelingTambahMuatanController::class);
    Route::resource('/jadwal-operasional', AfdelingJadwalOperasionalController::class);
    Route::post('/jadwal-operasional/status/{id}/{status}', [AfdelingJadwalOperasionalController::class, 'updateStatus'])->name('jadwal-operasional.status');
    //
});

// Group untuk pimpinan tanpa Route::namespace()
Route::middleware(['auth', 'role:3'])->name('pimpinan.')->prefix('pimpinan')->group(function () {
    Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('dashboard');
    Route::get('/data-operasional', [PimpinanDataOperasionalController::class, 'index'])->name('data-operasional.index');
    Route::get('/data-operasional/cetak', [PimpinanDataOperasionalController::class, 'cetak'])->name('data-operasional.form-cetak');
    Route::post('/data-operasional/cetak', [PimpinanDataOperasionalController::class, 'cetak'])->name('data-operasional.cetak');
    Route::get('/data-operasional/pdf', [PimpinanDataOperasionalController::class, 'pdf'])->name('data-operasional.pdf');
    Route::resource('/profile', PimpinanProfileController::class);
});

Route::get('/test-dashboard', function () {
    return view('template.dashboard');
});
Route::get('/get-data', function () {
    $data = User::with('karyawan')
        ->select('users.*')
        ->where('role_id', 2)->get();
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
