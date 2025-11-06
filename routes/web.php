<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuth;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\SejarahController as AdminSejarahController;
use App\Http\Controllers\Publik\SejarahController as PublikSejarahController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Publik\VisiMisiController as PublikVisiMisiController;
use App\Http\Controllers\Admin\ProfilBalaiController as AdminProfilBalaiController;
use App\Http\Controllers\Publik\ProfilBalaiController as PublikProfilBalaiController;
use App\Http\Controllers\Admin\BenihController;
use App\Http\Controllers\Admin\MasterBenihController;
use App\Http\Controllers\Admin\PemesananAdminController;
use App\Http\Controllers\Publik\LaporanBenihController as PublikLaporanBenihController;
use App\Http\Controllers\Admin\LaporanBenihController as AdminLaporanBenihController;
use App\Http\Controllers\Publik\LaporanIndukController as PublikLaporanIndukController;
use App\Http\Controllers\Admin\LaporanIndukController as AdminLaporanIndukController;
use App\Http\Controllers\Admin\MonitoringController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Halaman Publik
Route::get('/sejarah', [PublikSejarahController::class, 'index'])->name('sejarah');
Route::get('/visi-misi', [PublikVisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.form');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan');
Route::get('/profil-balai', [PublikProfilBalaiController::class, 'index'])->name('profil-balai');
Route::get('/laporan-benih', [PublikLaporanBenihController::class, 'index'])
    ->name('laporan-benih');
Route::get('/laporan-induk', [PublikLaporanIndukController::class, 'index'])
    ->name('laporan-induk');


// Google Auth
Route::get('/google', [GoogleAuth::class, 'redirectGoogle'])->name('google.auth');
Route::get('/google-callback', [GoogleAuth::class, 'handleGoogleCallback'])->name('google.login');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // ------------------------------
    // Route tanpa login (guest)
    // ------------------------------
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'AdminLogin'])->name('login');
        Route::post('/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('login_submit');

        // Lupa Password
        Route::get('/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('forget_password');
        Route::post('/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('password_submit');
        Route::get('/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword'])->name('reset_password');
        Route::post('/reset-password-submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('reset_password_submit');
    });

    // ------------------------------
    // Route untuk admin yang sudah login
    // ------------------------------
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
        Route::match(['get', 'post'], '/logout', [AdminController::class, 'AdminLogout'])->name('logout');

        // Konten Admin
        Route::get('/sejarah', [AdminSejarahController::class, 'index'])->name('sejarah');
        Route::post('/sejarah/update', [AdminSejarahController::class, 'update'])->name('sejarah.update');

        Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
        Route::post('/visi-misi/update', [VisiMisiController::class, 'update'])->name('visi-misi.update');

        Route::get('/profil-balai', [AdminProfilBalaiController::class, 'index'])->name('profil-balai.index');
        Route::post('/profil-balai/update', [AdminProfilBalaiController::class, 'update'])->name('profil-balai.update');

        // Pengelolaan Benih Ikan
        Route::resource('benih', BenihController::class);

         // <-- Sisipkan monitoring di sini -->
        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
        Route::get('/monitoring/create', [MonitoringController::class, 'create'])->name('monitoring.create');
        Route::post('/monitoring', [MonitoringController::class, 'store'])->name('monitoring.store');
        Route::get('/monitoring/{id}/monitoring', [MonitoringController::class, 'monitoring'])->name('monitoring.monitoring');
        Route::put('/monitoring/{id}', [MonitoringController::class, 'update'])->name('monitoring.update');
        Route::delete('/monitoring/{id}', [MonitoringController::class, 'destroy'])->name('monitoring.destroy');
        // Data Master Benih Ikan
        Route::resource('master-benih', MasterBenihController::class);

        // Pengelolaan Pemesanan
        Route::get('/pemesanan', [PemesananAdminController::class, 'index'])->name('pemesanan.index');
        Route::post('/pemesanan/{id}/konfirmasi', [PemesananAdminController::class, 'konfirmasi'])->name('pemesanan.konfirmasi');
        Route::post('/pemesanan/{id}/tolak', [PemesananAdminController::class, 'tolak'])->name('pemesanan.tolak');

        // Laporan Benih Ikan
        Route::get('/laporan-benih', [AdminLaporanBenihController::class, 'index'])->name('laporan-benih.index');
        Route::post('/laporan-benih/store', [AdminLaporanBenihController::class, 'store'])->name('laporan-benih.store');
        Route::delete('/laporan-benih/{id}', [AdminLaporanBenihController::class, 'destroy'])->name('laporan-benih.destroy');

        // Laporan Induk Ikan
        Route::get('/laporan-induk', [AdminLaporanIndukController::class, 'index'])->name('laporan-induk.index');
        Route::post('/laporan-induk/store', [AdminLaporanIndukController::class, 'store'])->name('laporan-induk.store');
        Route::delete('/laporan-induk/{id}', [AdminLaporanIndukController::class, 'destroy'])->name('laporan-induk.destroy');
    });
});


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
