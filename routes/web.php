<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilPanenController;
use App\Http\Controllers\Admin\PekerjaController;
use App\Http\Controllers\Admin\PemanenanController;
use App\Http\Controllers\Admin\PemeliharaanController;
use App\Http\Controllers\Admin\PemupukanController;
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

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:1'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/hasil-panen', HasilPanenController::class);
    Route::resource('/pemupukan', PemupukanController::class);
    Route::resource('/supir', PekerjaController::class);
    Route::resource('/afdeling', PekerjaController::class);
    Route::get('/pengguna', [DashboardController::class, 'index'])->name('pengguna');
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
    $data = PengangkutanHasilPanen::with('afdeling')
        ->whereNotNull('muatan_pabrik')
        ->whereNotNull('tandan_pabrik')
        ->orderBy('tanggal', 'desc')
        ->get();
        
    return response()->json(['data' => $data]);
})->name('get-data');
