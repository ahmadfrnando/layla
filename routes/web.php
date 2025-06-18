<?php

use App\Http\Controllers\Admin\AfdelingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilPanenController;
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
use App\Models\Pemeliharaan;
use App\Models\Pengangkutan;
use App\Models\PengangkutanHasilPanen;

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
    Route::resource('/profile', ProfileController::class);
    Route::resource('/hasil-panen', HasilPanenController::class);
    Route::resource('/afdeling', AfdelingController::class);
    Route::resource('/supir', SupirController::class);
    Route::resource('/pengguna', PenggunaHakAksesController::class);
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

// Group untuk pekerja tanpa Route::namespace()
Route::middleware(['auth', 'role:3'])->name('pekerja.')->group(function () {
    //
});

Route::get('/test-dashboard', function () {
    return view('template.dashboard');
});
Route::get('/get-data', function () {
    $data = PengangkutanHasilPanen::whereHas('pengangkutan', function ($query) {
        $query->where('user_id', auth()->user()->id);
    })->get();
    return response()->json($data);
})->name('get-data');

Route::get('/get-kode-pengangkutan', [AjaxLoadController::class, 'getKodePengangkutan'])->name('get-kode-pengangkutan');
Route::get('/search-kode-pengangkutan', [AjaxLoadController::class, 'getKodePengangkutan'])->name('search.kode-pengangkutan');
Route::get('/search-supir', [AjaxLoadController::class, 'getSupir'])->name('search.supir');
