<?php

use App\Http\Controllers\Admin\AfdelingController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilPanenController;
use App\Http\Controllers\Admin\PekerjaController;
use App\Http\Controllers\Admin\PemanenanController;
use App\Http\Controllers\Admin\PemeliharaanController;
use App\Http\Controllers\Admin\PemupukanController;
use App\Http\Controllers\Admin\PenggunaHakAksesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupirController;
use App\Http\Controllers\AjaxLoadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Manajer\DashboardController as ManajerDashboardController;
use App\Models\Pemeliharaan;
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

// Group untuk manajer tanpa Route::namespace()
Route::middleware(['auth', 'role:2'])->name('manajer.')->prefix('manajer')->group(function () {
    Route::get('/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');
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
    $pengangkutan = \App\Models\Pengangkutan::whereHas('pengangkutanHasilPanen', function ($query) {
        $query->where(function ($query) {
            $query->whereNull('muatan_pabrik')
                ->orWhereNull('tandan_pabrik');
        });
    })->get()->toArray();
    return response()->json($pengangkutan);
})->name('get-data');

Route::get('/get-kode-pengangkutan', [AjaxLoadController::class, 'getKodePengangkutan'])->name('get-kode-pengangkutan');
